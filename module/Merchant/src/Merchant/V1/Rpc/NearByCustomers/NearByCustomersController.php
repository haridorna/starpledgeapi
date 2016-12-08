<?php
namespace Merchant\V1\Rpc\NearByCustomers;

use Common\Tools\Util;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\TableGateway\TableGateway;
use Zend\View\Renderer\JsonRenderer;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Common\Tools\Logger;


class NearByCustomersController extends AbstractActionController
{
    public function nearByCustomersAction()
    {
        /*
         * Temporarily hadocoded data is supplied to feed iPhone client development
         *
         * TODO: need to re-implement this with correct service.
         */

        $content = $this->getRequest()->getContent();
         \Common\Tools\Logger::log("Mobile data input : " .$content."\n" );
        $content = json_decode($content);

        if(!property_exists( $content, "time_stamp")){
            $content->time_stamp = date('Y-m-d H:i:s');
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        // $content->merchant_id =1;
        if($content->merchant_id == 1){
            $tbl     = new TableGateway('nearby_customers', $adapter);
            $result  = $tbl->select()->toArray();

            $data = [];

            foreach ($result as $item) {
                $name = ucwords($item['first_name']) . ' ' . strtoupper(substr($item['last_name'], 0, 1));
                unset($item['first_name']);
                unset($item['last_name']);
                $item['total_cashback_rewards'] = "$".($item['total_loyalty_points']/10);
                $item['cashback_redeemed'] = "$".((int)str_replace("$",'',$item['total_purchases'])/10);
                $item['balance_cashback_rewards'] = "$".($item['loyalty_points_redeemed']/10);
                $spending_power = $item['spending_power'];
                if($spending_power <= 25){
                    $spending_power_level = "1";
                }elseif($spending_power > 25 && $spending_power <= 50 ){
                    $spending_power_level = "2";
                }elseif($spending_power > 50 && $spending_power <= 75){
                    $spending_power_level = "3";
                }else{
                    $spending_power_level = "4";
                }
                $notes = $item['notes'];
                if(!empty($notes)){
                    $notes = explode(',', $notes);
                    $notes1 = array();
                    foreach ($notes as $note) {
                        $userNotes = array();
                        if(count($note)){
                            $note = explode('|', $note);
                            //   var_dump($note);
                            if(count($note)==3){
                                $userNotes['notes'] =  trim($note[0]);
                                $userNotes['date'] =  trim($note[1]);
                                $userNotes['merchant_user_name'] =  trim($note[2]);
                                $notes1[] = $userNotes;
                            }

                        }

                        /* foreach($note as $k=>$v) {
                             if($v != ""){
                                 $v = trim($v);
                                 $note[$k] = $v;
                             }
                         }*/


                    }
                    $item['merchant_notes'] = $notes1;


                    unset($item['notes']);
                }else{
                    $item['merchant_notes'] =array();
                }

                $item['vip_privileges'] =json_decode($item['vip_privileges'], true);
                if (!is_array($item['vip_privileges'])) {
                    $item['vip_privileges'] = [];
                }
                $transaction_details = json_decode($item['transaction_details'], true);
                $transction = array();
                if(is_array($transaction_details) && count($transaction_details)>0){
                    foreach($transaction_details as $value){
                        $date = explode(" ", $value[0]);
                        $transction[] =  array("date"=>$date[0], "amount"=>$value[1]);
                    }
                }
                $item['transaction_details'] =$transction;
                $item['checkin_details'] =json_decode($item['checkin_details'], true);

                $locationType    = explode(',', $item['favorite_location_type']);
                $favLocationType = [];
                foreach ($locationType as $i) {
                    $type              = explode('|', $i);
                    $favLocationType[] = [
                        'percent' => $type[0],
                        'type'    => $type[1]
                    ];
                }
                $item['favorite_locations'] = explode(",", str_replace(", ", ",", trim($item['favorite_locations'])));

                $item['last_action_time'] = Util::timeElapsedString($item['last_action_ts']);

                $item['favorite_location_type'] = $favLocationType;
                //  $item['deals_eligible'] = $this->getDeals();
                $deals = $this->getRandomDeal();
                $reviews = $this->getRandomCustomerReviews();
                $item['no_of_deals'] = count($deals);
                $item['deals_eligible'] = $deals;
                //  $item['reviews'] = $this->getReviews();
                $item['no_of_reviews'] = count($reviews);
                $item['reviews'] = $reviews;
                $item = array("name"=>$name,'spending_power'=>$spending_power,'spanding_power_level'=> $spending_power_level )+$item;
                // array_unshift($item, "name => $name");
                $data[] = $item;
            }

//        return new JsonRenderer($data);
            return [
                'total' => count($data),
                'customers' => $data
            ];
        }

        if( property_exists($content, 'directions') && $content->direction == "AFTER") $direction=0;
        $merchantTable = new TableGateway('merchant', $adapter);

        $global_merchant_id = $merchantTable->select(['id'=>(int)$content->merchant_id], ['global_merchant_id']);

        if(!$global_merchant_id->count()){
          return  new ApiProblemResponse(new ApiProblem(422, "Merchant is not available"));
        }
        $global_merchant_id = $global_merchant_id->current();
        $merchant_id =  $global_merchant_id['global_merchant_id'];
        $direction = 1;
        if(property_exists($content, 'direction') && $content->direction == "AFTER") $direction = 0;
        \Common\Tools\Logger::log("SELECT `func_get_global_merchant_feed`(".$merchant_id.", $direction , '".$content->time_stamp."', 20, 10) as customer" );
        $result = $adapter->createStatement("SELECT `func_get_global_merchant_feed`(".$merchant_id.", $direction , '".$content->time_stamp."', 20, 10) as customer")->execute()->current();
        // \Common\Tools\Logger::log("Mobile data input : " .json_encode($result)."\n" );
        Logger::log("near by customer data : ".$result['customer']);
        $customer = json_decode($result['customer'], true);

        if(count($customer['customers'])>0){
            foreach($customer['customers'] as $key=>$value){
                $customer['customers'][$key]['last_action_time'] = Util::timeElapsedString($value['last_action_ts']);
            }
        }

         \Common\Tools\Logger::log("Mobile data input : " .json_encode(array_merge(array("total"=>count($customer['customers'])), $customer))."\n" );

        return array_merge(array("total"=>count($customer['customers'])), $customer);

    }

    private function getReviews()
    {
        $sql = "SELECT content, rating, review_date
                FROM global_merchant_reviews
                ORDER BY RAND()
                LIMIT 2";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql);

        $result =  $statement->execute();

        $data = [];
        foreach ($result as $item) {
            $data[] = $item;
        }

        return $data;
    }

    private function getDeals()
    {
        $sql   = "SELECT id, title, redeem_limit, retail_price, discount, detail, coupon_code, tags, global_merchant_id, address1, address2, city, state, zip, '06-12-2015' as expirty_date
                FROM merchant_deal
                ORDER BY RAND() LIMIT 2";

        $adapter   = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $statement = $adapter->createStatement($sql);

        $result =  $statement->execute();

        $data = [];
        foreach ($result as $item) {
            $data[] = $item;
        }

        return $data;
    }

    private function getRandomCustomerReviews(){
            $number_of_reviews = rand(1,7);
            if($number_of_reviews == 4){
                return array();
            }
            $reviews = array(
                1=>array( "review_text"=> Util::clearTextSpaces("This place, without fail, will make the panties drop.  Great dining experience overall.
                    I'd like to merely pay homage to this highly acclaimed restaurant, as it continues to deserve the limelight. All I have to say is that service was superior here--one of the reasons why I ultimately decided to give this place 4 stars, instead of 3 stars. Another reason for 4 stars, is the exquisite cook of the meat and fish we had.
                     We had the opportunity to try:
                    . Risotto w/ rock shrimp, Dungeness crab, shimeji mushrooms, asparagus and peas: One word--stunning. This one had such superb flavor that we didn't mind that it didn't come with more protein. Lusciously creamy risotto was cooked to perfection.
                    . Seared Foie Gras and caramelized onions: It was beautifully cooked, but its delicate flavors were obscured by a sauce and by the distracting sweetness of the onions. "),
                   "timestamp"=>Util::timeElapsedString("2015-07-20 20:05:00"),
                    "star_rattings"=>"4"
                ),

                2=>array("review_text"=>  Util::clearTextSpaces("EPIC DINING.

                    Had such an amazing time here. Highly recommend the wine pairing, as the sommelier came out before each course, pouring each wine himself and explaining how it was about to blow your mind with your next course.

                    In retrospect my only regret was the crab and avocado salad, as it was the least unique thing in their entire menu - besides that, we were wowed with every drink, every course, and the never ending dessert.

                    Lastly the banana bread they give you to go, for the next morning's breakfast was the best way to continue the epic dining experience into the next day. We saw other tables get one per person, but we only got one - no big - everything else was incredible.

                    Highly recommend it for a special occasion."),
                    "timestamp"=>Util::timeElapsedString("2015-03-27 17:55:00"),
                    "star_rattings"=>"5"
                    ),

                3=>array("review_text"=>   Util::clearTextSpaces(" Fabulous fabulous Fabulous! Went there last night for a friends birthday and we were treated like royalty. Staff was super friendly and even cracked s few jokes. The menu wasn't too overwhelming but everything looked good and it was difficult to pick. My favorite of the night crab, shrimp risotto and the sea scallops.

                    A couple fun things....they hung my purse from the table with a special monogrammed GD purse holder, we got a plate of treats at the end of the meal and we were sent home with a breakfast treat for the next day."),
                    "timestamp"=>Util::timeElapsedString("2015-07-03 18:00:00"),
                    "star_rattings"=>"3.5"

                ),

                4=>array("review_text"=>  Util::clearTextSpaces("We went here for our anniversary so we made reservations about 2 months in advance.  Unfortunately at the time we could only get early reservations so ended up eating at 5:30.  We used the valet because it was Friday night and parking was crazy, it was 15$ but most garages around the area cost more.  I had originally thought I was going to get the 3 courses but once I got there and opened up the menu I just had to take advantage of this meal and both my husband and I ordered the 5 courses.  While we were decided we both had a cocktail which was pretty good.  We also got some bread and the amuse bushe
                    Our dishes:
                    glazed oysters- AMAZING!  Perhaps my favorite dish of the night.  This appetizer is just delicious!

                    Risotto- This was pretty good as well, they told us that it was the most popular dish.  it had quite a bit of seafood and really cooked well.

                    foie gras- this was just okay to me I wouldn't get this again.  But the wine pairing with this dish was GREAT!  I was really impressed with this.

                    Sea bass- DELICIOUS!!!  This fish was amazing and the cous cous that came with it was amazing as well and the sauce was great. "),
                    "timestamp"=>Util::timeElapsedString("2015-05-13 11:20:00"),
                    "star_rattings"=>"4.5"

                ),

                5=>array("review_text"=>   Util::clearTextSpaces("I came here recently with three other friends and had an exceptional dining experience. We each got the 5-course meal.

                    Seared Foie Gras: This was probably my favorite of the 5 courses. As foie gras should, it melted in my mouth. Flavoring was perfect.

                    Roasted Maine Lobster: Lobster is lobster. Mashed potatoes that came with was very buttery.

                    Lemon Pepper Duck Breast: The sauce that accompanied the duck was very yummy, but have to say that the duck itself was not as tender as I imagined it would be. I've had better at other places.

                    Juniper Crusted Bison: Started to slow down a lot by this course. If I'm comparing to the rest, this would be my least favorite. Bison meat is a bit tough. Sauce is very savory though.

                    Last course was dessert, Chocolate Souffle: The chocolate in the souffle was very decadent and rich, but bread part was very dry. Overall was just OK."),
                    "timestamp"=>Util::timeElapsedString("2015-06-13 14:35:00"),
                    "star_rattings"=>"2.5"

                ),
                6=>array("review_text"=> Util::clearTextSpaces("This is by far the one of the best fine dining I've been to, and one that took a piece of my heart leaving it in SF.  Went here with the GF, and she too was impressed by the quality, presentation, service, and the sophistication of the premise.  It was a bit awkward, and trust me I don't get into this awkwardness moments, but the place directly transported me to euphoria (even while I was wearing super casual), and gave me that sense of 'hello master, I know you look like a hobo, but we will gladly serve you and impress your standards.' We got the seared filet of beef and seared sea scallops, and omg.. it melts in your mouth good... Enough with the descriptions....if you're in SF, you must go and try the place out!! You won't be disappointed, and if you do..well you are [ fill in the blank ].

                    SOLID 5. 5 for everything!!!"),
                    "timestamp"=>Util::timeElapsedString("2015-04-27 08:35:00"),
                    "star_rattings"=>"4"

                ),
                7=>array("review_text"=> Util::clearTextSpaces("I had imagine this forever and when it was my chance to go, well it's time, it was for the lack of word to compare PERFECT 10.
                    So saved for ages, and bought dinner for me and my husband, well it's in my very own bucket list.
                    Do it, save your money, get the 2 months reserve advance and start counting...
                    you will not regret it.
                    The service staff- on the mark 5 stars
                    The dessert--to die for souffle'
                    The risotto--wow!
                    The scallops--amazing!
                    ok, if there is really anything I could change...music, live one that is, violin, piano, saxophone...ok, there is no harm in suggesting!
                    so thank you! i will always remember that one day when i went to gary danko! In celebrating my 10th year anniv at work, and 39th birthday every penny well spent."),
                    "timestamp"=>Util::timeElapsedString("2015-06-10 08:35:00"),
                    "star_rattings"=>"1"

                )
            );

        shuffle($reviews);
        if(is_array($reviews)){
            // to send the blank 0 reviews to handle
            return array_slice($reviews, $number_of_reviews);
        }
        return array();
    }

    function getRandomDeal(){
        $number_of_reviews = rand(1,7);
        if($number_of_reviews == 4){
            return array();
        }
        $random_number = array();
       for($i=1; $i<8; $i++){
           $random_number[$i] = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0,10);
       }

        $deals = array(
            1=> array("id"=>20, "title"=>"Burgers and Bar Food for Two or Four at Polk Street Pub (50% Off)",
                "redeem_limit"=> "1",
                "retail_price"=>  "$30.00",
                "discount"=> "$15.00",
                "coupon_code"=> $random_number[1],
                "summary"=>"Polk Street Pub",
                "detail"=>  Util::clearTextSpaces(' Unlike robotic parents, a beer and a burger are a natural pair. Initiate hunger protocol with this Groupon.Choose Between Two Options
                    $15 for $30 worth of pub food for two
                    $30 for $60 worth of pub food for four
                    Polk Street Pub
                    Watching TV after midnight is typically a sign of insomnia, but at Polk Street Pub, it’s simply a sign of a good time. The South Loop pub stays open past midnight nightly playing the latest sports games and other engaging programs on its many flat-screen TVs. As they watch a baseball player swing for the fences or a basketball player slam a poster-worthy dunk, patrons can chow down on the pub\'s hearty food made from fresh ingredients. Appetizers include three kinds of egg rolls – Irish, Philly, or blackened chicken – as well as wings with six types of available sauces, and the hand-cut French fries are touted as some of the South Loop\'s best. The deliciousness continues with the entrees, which include build-your-own burgers and sandwiches ranging from high-stacked Reubens and Philly cheesesteaks to the popular cheesy garlic chicken.
                    As Blue Line trains clatter past nearby, patrons can also pair their meals with pints from the pub\'s extensive beer list, which includes everything from no-frills American favorites to boundary-pushing craft brews. The pub also maintains a full bar, and schedules daily drink specials that increase the good times without decreasing wallet size. No matter the reason for their visit, patrons can relax inside the pub\'s comfortable atmosphere, even taking advantage of free Wi-Fi to get some web surfing done during their stay.
                '),
                "address1"=> "South Loop ",
                "address2"=> "548 W Polk St.",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60607",
                "expiry_date"=> "08-15-2015"
            ),
            2=> array("id"=>25, "title"=>"Sliders or Tacos and Beer for Two or Four at Vinyl Restaurant (50% Off)",
                "redeem_limit"=> "2",
                "retail_price"=>  "$38.00",
                "discount"=> "$19.00",
                "coupon_code"=> $random_number[2],
                "summary"=>" $38 for sliders or tacos and beer for four",
                "detail"=>  Util::clearTextSpaces('Choose Between Two Options
                  $19 for sliders or tacos and beer for two ($38 value)
                  $38 for sliders or tacos and beer for four ($76 value)
                Each option includes the following per person:
                  Three beef sliders or tacos
                  One 12 oz. craft beer
                    Vinyl
                   Maybe it\'s the records on the wall, the pool tables in the basement, or the gourmet menu of Latin fusion cuisine. Maybe it\'s the cover-free fight nights or the soundtrack—everything from new wave to hip-hop to indie rock. Whatever is your favorite part about Vinyl, one thing\'s for certain: the restaurant does things a little differently from any other in the city.
                 The menu punctuates this with a lineup of spicy, playful dishes. The Fleetwood Mac and Cheese, for example, combines white cheddar and toasted brioche with the surprising crunch of Goldfish crackers. The "handhelds" section includes burgers slathered with jalapeño aioli and pulled pork sliders. Equally handheld are Vinyl\'s corn-tortilla tacos stuffed with spare rib, fish, and barbacoa. High-end whiskeys and craft beers stand out on the drink list, inviting visitors to try brews such as the Victory Golden Monkey instead of boring cocktails such as "water on the rocks".'
                ),
                "address1"=> "Near North Side ",
                "address2"=> "121 West Hubbard Street",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60654",
                "expiry_date"=> "25-09-2015"

            ),
            3=> array("id"=>20, "title"=>"$12 for $20 Worth of Mexican and Italian Dinner Food for Dine-In for Two or More at El Ranchito",
                "redeem_limit"=> "0",
                "retail_price"=>  "$13.00",
                "discount"=> "$12.00",
                "coupon_code"=>$random_number[3],
                "summary"=>"$12 for $20 worth of Mexican and Italian dinner food for dine-in",
                "detail"=>  Util::clearTextSpaces('The Deal
                $12 for $20 worth of Mexican and Italian dinner food for dine-in for two or more

                View Groupon Delivery and Takeout deals for El Ranchito’s Grand Avenue, Clark Street, and Milwaukee Avenue locations.
                El Ranchito
                    A trio of El Ranchito restaurants populates the Chicagoland area, providing hearty meals that run the gamut from Mexican and Italian specialties to American classics. Omelets and skillets filled with veggies, chorizo, and cheese are available for breakfast, and the menu offers a seemingly endless array of burritos, tacos, and steak dinners later in the day. The chefs also dabble in gourmet pizzas, ribs, and fresh seafood.
                    Depending on the location, guests are also greeted with various entertainment and amenities. The Milwaukee and Grand Avenue spots feature live mariachi bands on Sundays, as well as karaoke nights and fully stocked bars. The Clark Street location, meanwhile, is BYOB, allowing guests to bring their own beers or grape-stomping barrels.
                '),
                "address1"=> "Belmont Central",
                "address2"=> "5959 W Grand Ave",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60639",
                "expiry_date"=> "08-12-2015"
            ),
            4=> array("id"=>48,
                "title"=>"$27 for Dinner for Two at Cy's King Crab Oyster Bar & Grill ($49.85 Value)",
                "redeem_limit"=> "1",
                "retail_price"=>  "$49.85",
                "discount"=> "$27",
                "coupon_code"=> $random_number[4],
                "summary"=>"$27 for dinner for two with one appetizer",
                "detail"=> Util::clearTextSpaces('
                    Going out for a satisfying meal is a natural start to a night out, since most nightclub bouncers will only let you in if you look content. Eat, drink, and be merry with this Groupon.The Deal

                      $27 for dinner for two with one appetizer (up to $9.95) and two entrees (up to $19.95 each) (a $49.85 value)
                      Cy\'s King Crab Oyster Bar & Grill

                       Cy\'s King Crab Oyster Bar & Grill, the latest project from the team behind of fresh crustaceans and cooked-to-order fish to Noble Square. Chefs shuck oysters and heap plates with juicy Alaskan king, dungeness, and snow crab legs alongside wedges of lemon and dipping sauces, and fishier catches can be broiled, grilled, blackened, fried, or banished from the bar at the diner\'s whim.

                        Prime steaks, kebabs, and pasta dishes round out the menu, and a stocked bar allows diners to pair each bite with the libation of their choice. In the warmer months, guests can dine on a spacious outdoor patio beneath a cover of tree branches.
                   ') ,
                "address1"=> "Central Chicago ",
                "address2"=> "695 N Milwaukee Ave",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60642",
                "expiry_date"=> "07-29-2015"
            ),
            5=> array("id"=>57, "title"=>"$30 for $60 Worth of Contemporary American Cuisine with Panoramic Skyline Views at Cité ",
                "redeem_limit"=> "1",
                "retail_price"=>  "$60",
                "discount"=> "$30",
                "coupon_code"=> $random_number[5],
                "summary"=>" $30 for $60 worth of contemporary American cuisine",
                "detail"=>  Util::clearTextSpaces('The Deal
                      $30 for $60 worth of contemporary American cuisine
                    Cité
                    Guests at Cité bask in a 360-degree view of Lake Michigan, Navy Pier, and Chicago—along with an eye-level view of summer fireworks—from the 70th floor of Lake Point Tower. But that shouldn\'t distract from what\'s on the tables there.  Chef Christopher Cubberley has worked in the triple-Michelin-starred Essex House and served as the personal chef to Martha Stewart. But some of his skill might run in the family as well; his mother was a pastry chef, and she started teaching him young.
                    Cubberley\'s varied background shows in dishes worthy of the adventurous space. Cured salmon pulls in an unexpected splash of yuzu vinaigrette, and tempura-battered apples and dried cherries add some hint of the forest to Berkshire pork. And the wine menu, which spans the New and Old World, provides another reason to linger over the skyline vista.
                '),
                "address1"=> "Near North Side ",
                "address2"=> "505 N Lake Shore Dr",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60611",
                "expiry_date"=> "17-09-2015"
            ),
            6=> array("id"=>86, "title"=>"Tapas and Sangria for Two or Four at Gaudi Café (Up to 52% Off)",
                "redeem_limit"=> "0",
                "retail_price"=>  "$62.95",
                "discount"=> "$33.00",
                "coupon_code"=> $random_number[6],
                "summary"=>"$61 for a tapas meal for four",
                "detail"=>  Util::clearTextSpaces('Choose Between Two Options
                    $33 for a tapas meal for two ($62.95 value)
                    Five tapas plates (up to an $8.99 value each)
                    One pitcher of sangria (an $18 value)
                    $61 for a tapas meal for four ($125.90 value)
                    Ten tapas plates (up to an $8.99 value each)
                    Two pitchers of sangria (an $18 value each)

                Gaudi Café
                   At its new digs, a simple sign advertises the entrance to Gaudi Café, which is housed inside a quaint West Town brownstone and encircled by plenty of outdoor seating. Though named for a Spanish architect, the cafe doesn’t strictly stick to Spanish fare; rather, the founders mingle Barcelonan culture and cuisine with Mexican and American traditions.
                    The menu, designed for enjoying in-house or on the go, features everything from chorizo breakfast burritos and chocolate-chip pancakes to nine burgers named for artistic greats, such as the Dali served on a goat cheese croquette. Chefs also prepare traditional Spanish tapas, such as spicy calamari and Spanish chorizo. Despite its eclectic selection of treats, Gaudi is, at its core, a cafe where baristas concoct organic soy lattes, Mexican hot chocolate, and originals, such as soy coconut horchata.
                '),
                "address1"=> "West Town ",
                "address2"=> "1147 W Grand Ave",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60642",
                "expiry_date"=> "25-11-2015"
            ),
            7=> array("id"=>53, "title"=>"Indian Food for Takeout or Eat-In Dinner for Two at Raj Darbar (Up to 45% Off)",
                "redeem_limit"=> "0",
                "retail_price"=>  "$40.00",
                "discount"=> "$22.00",
                "coupon_code"=> $random_number[7],
                "summary"=>"$13 for $20 worth of Indian takeout",
                "detail"=>  Util::clearTextSpaces('Naan is hard to resist due to its soft, fluffy texture and the way that saying its name forces you to open your mouth as wide as you can. Give in to naan with this Groupon.Choose Between Two Options
                  $22 for $40 worth of Indian food and drinks for two or more
                  $13 for $20 worth of Indian takeout
                  Valid for pickup
                  Orders available: Monday–Sunday, 1 pm- 10 pm; Friday- Saturday, 1 pm- 11 pm
                How to Order for Pickup
                Purchase offer for pickup.
                  Click “Order Now” on the confirmation page, or visit “My Groupons” at any time to begin your order.
                  Select “pickup” to view the menu, place your order, and automatically apply your Groupon.
                  You’ll receive a confirmation email with the time your order will be ready.
                Raj Darbar
                   Raj Darbar, celebrating 23 years in business and a four-time recipient of Michelin\'s Bib Gourmand rating for good value, honors centuries-old Indian culinary traditions with a menu of wholesome dishes prepared to order and cooked in the tandoor, an Indian-style clay oven. Fired by charcoal and heated to 900 degrees on the sides, the tandoor locks in meat\'s natural juices and the flavors of herbs, spices, and rambunctious genies. Ingredients such as turmeric, cardamom, and ginger balance out each bite against the zestier flavors, as do four types of chutney.
                '),
                "address1"=> "DePaul ",
                "address2"=> "2660 N Halsted St",
                "city"=> "Chicago",
                "state"=> "IL",
                "zip"=> "60614",
                "expiry_date"=> "04-09-2015"
            )
        );

        shuffle($deals);
        if(is_array($deals)){
            // to send the blank 0 reviews to handle
            return array_slice($deals, $number_of_reviews);
        }
        return array();
    }
}
