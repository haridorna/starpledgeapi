<?php
namespace Customer\V1\Rpc\CustomerDetails;

use Customer\V1\Model\CustomerDetails;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Auth\User;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
class CustomerDetailsController extends AbstractActionController
{
    public function customerDetailsAction()
    {
        $customerId = $this->getEvent()->getRouteMatch()->getParam('customer_id');
        $merchantId = $this->getEvent()->getRouteMatch()->getParam('merchant_id');
        // user validation
        $user = User::getInfo();

        if (!$user) {
            return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
        }
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $merchantTable = new TableGateway('merchant' , $adapter);
        $global_merchant_id = $merchantTable->select(['id'=>(int)$merchantId], ['global_merchant_id']);
        if(!$global_merchant_id->count()){
            return  new ApiProblemResponse(new ApiProblem(422, "Merchant is not available"));
        }

        $global_merchant_id = $global_merchant_id->current();
        $global_merchant_id =  $global_merchant_id['global_merchant_id'];

        $query = "SELECT `func_get_customer_global_merchant`($global_merchant_id, $customerId, 1, now(), 10) as customer";
        \Common\Tools\Logger::log(" db query: " .$query."\n" );
        $result = $adapter->createStatement($query)->execute()->current();
        \Common\Tools\Logger::log("customer response : " .$result['customer']."\n" );
        $details = json_decode($result['customer'], true);
        return  $details;
        /*$details = new CustomerDetails($this->getServiceLocator());
        return $this->dummyDataForCustomerDetails();*/
       // return $details->getDetails($customerId);
    }

    function dummyDataForCustomerDetails(){
        return json_decode('{
            "name": "Sarah W",
            "spending_power": "60%",
            "spanding_power_level": "3",
            "id": "100000000032",
            "profile_image_big": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
            "profile_image_small": "http://www.dannyst.com/blogimg/gallery-portraits-of-strangers-15.jpg",
            "industry_grade": "A+",
            "loyalty_rank": "48",
            "social_influence": "A+",
            "is_top_customer": "20%",
            "vip_privileges": [
                {
                    "option_text": "Priority Treatment",
                    "option_icon_url": "https://biz.privme.com/massets/images/service-options/priority-treatment.png"
                },
                {
                    "option_text": "Free Parking",
                    "option_icon_url": "https://biz.privme.com/massets/images/service-options/free-parking.png"
                }
            ],
            "average_check": "$24.55 ",
            "total_loyalty_points": "540",
            "total_purchases": "$270.35 ",
            "loyalty_points_redeemed": "140",
            "balance_loyalty_points": "400",
            "transactions_at_restaurant": "2",
            "transaction_details": [
                {
                    "date": "2015-03-01",
                    "amount": "$14.25"
                },
                {
                    "date": "2015-02-17",
                    "amount": "$10.45"
                }
            ],
            "checkins_at_restaurant": "5",
            "checkin_details": [
                "2015-03-5 11:40:00",
                "2015-03-01 11:05:00",
                "2015-02-17 12:15:00",
                "2015-02-10 10:55:00",
                "2015-02-05 10:30:00"
            ],
            "statistics": "Restaurant & Dining",
            "avg_transaction_amount": "$74.34 ",
            "favorite_locations": [
                "Oscar Mexican Seafood",
                "Ricky Fish Tacos",
                " T-Deli"
            ],
            "favorite_location_type": [
                {
                    "percent": "70",
                    "type": "Sushi"
                },
                {
                    "percent": "30",
                    "type": "Steakhouse"
                }
            ],
            "like_status": "yes",
            "last_action_ts": "2015-06-10 08:35:00",
            "last_action_type": "reservations",
            "out_of_coverage": "1",
            "total_cashback_rewards": "$54",
            "cashback_redeemed": "$27",
            "balance_cashback_rewards": "$14",
            "merchant_notes": [
                {
                    "notes": "she is a nice customer",
                    "date": "03/21/2015",
                    "merchant_user_name": "William"
                }
            ],
            "last_action_time": "3 months ago",
            "no_of_deals": 1,
            "deals_eligible": [
                {
                    "id": 53,
                    "title": "Indian Food for Takeout or Eat-In Dinner for Two at Raj Darbar (Up to 45% Off)",
                    "redeem_limit": "0",
                    "retail_price": "$40.00",
                    "discount": "$22.00",
                    "coupon_code": "4GBD2M38NY",
                    "summary": "$13 for $20 worth of Indian takeout",
                    "detail": "Naan is hard to resist due to its soft, fluffy texture and the way that saying its name forces you to open your mouth as wide as you can. Give in to naan with this Groupon.Choose Between Two Options\n $22 for $40 worth of Indian food and drinks for two or more\n $13 for $20 worth of Indian takeout\n Valid for pickup \n Orders available: Monday–Sunday, 1 pm- 10 pm; Friday- Saturday, 1 pm- 11 pm \n How to Order for Pickup\n Purchase offer for pickup.\n Click \"Order Now\" on the confirmation page, or visit \"My Groupons\" at any time to begin your order. \n Select \"pickup\" to view the menu, place your order, and automatically apply your Groupon. \n You will receive a confirmation email with the time your order will be ready.\n Raj Darbar\n Raj Darbar, celebrating 23 years in business and a four-time recipient of Michelins Bib Gourmand rating for good value, honors centuries-old Indian culinary traditions with a menu of wholesome dishes prepared to order and cooked in the tandoor, an Indian-style clay oven. Fired by charcoal and heated to 900 degrees on the sides, the tandoor locks in meats natural juices and the flavors of herbs, spices, and rambunctious genies. Ingredients such as turmeric, cardamom, and ginger balance out each bite against the zestier flavors, as do four types of chutney. \n ",
                    "address1": "DePaul ",
                    "address2": "2660 N Halsted St",
                    "city": "Chicago",
                    "state": "IL",
                    "zip": "60614",
                    "expiry_date": "04-09-2015"
                }
            ],
            "no_of_reviews": 3,
            "reviews": [
                {
                    "review_text": " Fabulous fabulous Fabulous! Went there last night for a friends birthday and we were treated like royalty. Staff was super friendly and even cracked s few jokes. The menu wasnt too overwhelming but everything looked good and it was difficult to pick. My favorite of the night crab, shrimp risotto and the sea scallops.\n A couple fun things....they hung my purse from the table with a special monogrammed GD purse holder, we got a plate of treats at the end of the meal and we were sent home with a breakfast treat for the next day.",
                    "timestamp": "2 months ago",
                    "star_rattings": "3.5"
                },
                {
                    "review_text": "I came here recently with three other friends and had an exceptional dining experience. We each got the 5-course meal.\n Seared Foie Gras: This was probably my favorite of the 5 courses. As foie gras should, it melted in my mouth. Flavoring was perfect.\n Roasted Maine Lobster: Lobster is lobster. Mashed potatoes that came with was very buttery.\n Lemon Pepper Duck Breast: The sauce that accompanied the duck was very yummy, but have to say that the duck itself was not as tender as I imagined it would be. I have had better at other places.\n Juniper Crusted Bison: Started to slow down a lot by this course. If I am comparing to the rest, this would be my least favorite. Bison meat is a bit tough. Sauce is very savory though.\n Last course was dessert, Chocolate Souffle: The chocolate in the souffle was very decadent and rich, but bread part was very dry. Overall was just OK.",
                    "timestamp": "2 months ago",
                    "star_rattings": "2.5"
                },
                {
                    "review_text": "I had imagine this forever and when it was my chance to go, well it is time, it was for the lack of word to compare PERFECT 10.\n So saved for ages, and bought dinner for me and my husband, well it is in my very own bucket list.\n Do it, save your money, get the 2 months reserve advance and start counting...\n you will not regret it.\n The service staff- on the mark 5 stars\n The dessert--to die for souffle \n The risotto--wow!\n The scallops--amazing!\n ok, if there is really anything I could change...music, live one that is, violin, piano, saxophone...ok, there is no harm in suggesting!\n so thank you! i will always remember that one day when i went to gary danko! In celebrating my 10th year anniv at work, and 39th birthday every penny well spent.",
                    "timestamp": "3 months ago",
                    "star_rattings": "1"
                }
            ]
        }', "true");
    }
}
