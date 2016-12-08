<?php
/**
 * Created by JetBrains PhpStorm.
 * Author: hari
 * Date: 26/12/14
 * Time: 3:36 PM
 */

namespace Console\Controller;

use Admin\Model\BulkMerchantDescriptionMap;
use Common\Tools\Logger;
use Console\Model\BulkMerchantSearchImport;
use Console\Model\BulkMerchantSearchImportAZ;
use Console\Model\EmailSender;
use Console\Model\MysqlProcedureCall;
use Console\Model\Restaurants\RestaurantMerchant;
use Console\Model\SQS;
use Console\Model\Yipit\YipitMerchant;
use Customer\V1\Model\CustomerCashback;
use Customer\V1\Model\CustomerDetails;
use Customer\V1\Model\Merchant;
use Customer\V1\Model\PushNotification;
use Customer\V1\Model\SendEmailNotification;
use Customer\V1\Model\SendEmailTemplate;
use Facebook\V1\Model\FacebookFeed;
use Facebook\V1\Model\FacebookFeedByFBAPI;
use Finicity\V1\Model\TransactionFetchFinicityDirect;
use Intuit\V1\Model\CustomerAccount;
use Intuit\V1\Model\ProcCall;
use Intuit\V1\Model\TransactionsFetch;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Merchant\V1\Model\MerchantReview;
use Customer\V1\Model\MerchantTimings;
use Yelp\V1\Model\Scraper;
use Yodlee\V1\Model\Transactions;
use Zend\Console\Request as ConsoleRequest;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;


/**
 * Class CronController
 * @package Console\Controller
 * @author  Hari Dornala
 */
class CronController extends AbstractActionController
{
    public function processAccountAction()
    {
        $request        = $this->getRequest();
        $serviceLocator = $this->getServiceLocator();

        if (!$request instanceof ConsoleRequest) {
            throw new \RuntimeException('You can only use this action from a console!');
        }

        $sqs           = new SQS($serviceLocator);
        $message       = $sqs->getMessage('yodlee-transactions');
        $body          = $message['Body'];
        $receiptHandle = $message['ReceiptHandle'];

        if (!is_array($body)) {
            echo "No message received, nothing to be done.\n";
            Logger::log("No SQS message received for id 'yodlee-transactions', nothing to be done.");

            return;
        }

        $memSiteAccId = $body['memSiteAccId'];
        $transactions = new Transactions($serviceLocator);
        $result       = $transactions->processByMemSiteAccId($memSiteAccId);

        if ($result) {
            $sqs->deleteMessage('yodlee-transactions', $receiptHandle);
            Logger::log("Transactions process for memSiteAccId=$memSiteAccId is completed successfully");
            echo "Transactions process for memSiteAccId=$memSiteAccId is completed successfully\n";
        } else {
            Logger::log("Transactions process for memSiteAccId=$memSiteAccId is is failed");
            echo "Transactions process for memSiteAccId=$memSiteAccId is is failed\n";
        }
    }

    public function processAllAccountsAction()
    {
        Logger::log("PROCESS-ALL-ACCOUNTS: Started processing");
        $transactions = new Transactions($this->getServiceLocator());
        $transactions->processAllAccounts();
        Logger::log("PROCESS-ALL-ACCOUNTS: Ended processing");

        echo "Done";
    }

    /*public function facebookPostAnalyticsAction()
    {
        $customerId     = $this->getRequest()->getParam('customerId');
        $serviceLocator = $this->getServiceLocator();
        $feed           = new FacebookFeed($serviceLocator, $customerId);
        $result         = $feed->addFeed()
                               ->processFeed()
                               ->getResult();

        echo "CustomerId: $customerId " . date('Y-m-d') . " Executed Successfully. Data: " . json_encode($result) . "\n";
    }*/

    public function facebookPostAnalyticsAction()
    {
        $customerId     = $this->getRequest()->getParam('customerId');
        $serviceLocator = $this->getServiceLocator();
        $feed           = new FacebookFeedByFBAPI($serviceLocator, $customerId);
        $result         = $feed->addFeed()
                            ->processFeed()
                            ->getResult();

        echo "CustomerId: $customerId " . date('Y-m-d') . " Executed Successfully. Data: " . json_encode($result) . "\n";
    }

    public function getAllCustomerFacebookFeedAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql     = "SELECT id, facebook_access_token
                FROM `customer`
                WHERE facebook_access_token IS NOT NULL";

        $statement = $adapter->createStatement($sql, array());
        $result    = $statement->execute();

        foreach ($result as $record) {
            $customerId          = $record['id'];
            $facebookAccessToken = $record['facebook_access_token'];

            $feed   = new FacebookFeed($this->getServiceLocator(), $customerId, $facebookAccessToken);
            $result = $feed->addFeed();

            if ($result) {
                $feed->processFeed()
                     ->getResult();

                $message = "CustomerId: $customerId " . date('Y-m-d H:i:s') . " Executed Successfully. Data: " . json_encode($result) . "\n";
            } else {
                $message = "CustomerId: $customerId " . date('Y-m-d H:i:s') . " Executed with issues\n";
            }

            Logger::log($message);

        }
    }

    public function intuitTransactionFetchAction()
    {
        $customerId    = $this->getRequest()->getParam('customerId');
        $accountId     = $this->getRequest()->getParam('accountId');
        $institutionId = $this->getRequest()->getParam('bankId');

        $transactionsFetch = new TransactionsFetch($this->getServiceLocator());
        $result            = $transactionsFetch->fetchTransactions($customerId, $accountId, $institutionId);
        Logger::log(json_encode($result));
        echo json_encode($result);
        exit;
    }

    public function fetchTransactionsAndAnalyzeAction()
    {
        $option = $this->getRequest()->getParam('option');

        $model = new TransactionsFetch($this->getServiceLocator());
        $model->fetchTransactionsAndAnalyze();

        if ($option == 'sendEmail') {
            $emailSender = new EmailSender($this->getServiceLocator());
            $emailSender->emailUnmappedTransactions();
        }

        $message = 'fetch-transactions-and-analyze';
        Logger::log($message);

        echo $message . ' at ' . date('Y-m-d H:i:s');
        exit;

    }

    /**
     * Bulk Merchant map script
     * Params expected $start $limit
     */
    public function bulkMerchantMapAction()
    {
        $limit = $this->getRequest()->getParam('limit', 10);
        $map   = new BulkMerchantDescriptionMap($this->getServiceLocator());
        echo json_encode($map->process($limit));
        exit;
    }

    /**
     * @summary calling proc_merchant_description_map procedure in background while addSiteAccount
     */
    function procMerchantDescriptionMapAction()
    {
        $customer_id  = $this->getRequest()->getParam('customer_id');
        try{
            $procCallObj = new ProcCall($this->getServiceLocator());
            $procCallObj->procMerchantDescriptionCall($customer_id);
        }catch (\Exception $e){
           Logger::log($e->getMessage());
        }

    }

    public function bulkMerchantSearchAndImportAction()
    {
        try {
            $modal = new BulkMerchantSearchImport($this->getServiceLocator());
            $modal->execute();
        } catch (\Exception $e) {
            Logger::log('Problem encountered in bulkMerchantSearchAndImport, Reason: ' . $e->getMessage());
        }
        echo date ('Y-m-d H:i:s') . ": Successfully Finished bulkMerchantSearchAndImport cron\n";
        Logger::log('Successfully Finished bulkMerchantSearchAndImport cron');
    }

    public function bulkMerchantSearchAndImportAZAction()
    {
        try {
            $modal = new BulkMerchantSearchImportAZ($this->getServiceLocator());
            $modal->execute();
        } catch (\Exception $e) {
            echo  'Problem encountered in bulkMerchantSearchAndImportAZ, Reason: ' . $e->getMessage();
            Logger::log('Problem encountered in bulkMerchantSearchAndImportAZ, Reason: ' . $e->getMessage());
        }
        echo date ('Y-m-d H:i:s') . ": Successfully Finished bulkMerchantSearchAndImportAZ cron\n";
        Logger::log('Successfully Finished bulkMerchantSearchAndImportAZ cron');
    }

    public function sendBankLoginFailedEmailAction(){

        // TODO : commented code as issue occured in Intuit service. Need to uncomment as Intuite will work fine

        $customer_id = $this->getRequest()->getParam('customer_id');

        try {
            $intuiteCustomerAccObj = new CustomerAccount($this->serviceLocator);
            $inactiveAcc = $intuiteCustomerAccObj->getInActiveCustomerForBank($customer_id);

            if(!$inactiveAcc) throw new \Exception('Inactive customer not found');

            $templateObj = new SendEmailTemplate($this->serviceLocator);
            $pushNotificationObj = new PushNotification($this->getServiceLocator());

            foreach($inactiveAcc as $acc){
                $templateObj->sendFailedBankLinkCardTemplate($acc['customerId'], $acc['bankId']);
                $pushNotificationObj->sendNotifictionForInActiveBankAcc($acc['customerId']);
            }
        }catch(\Exception $e){
            Logger::log('Inactive Customer for Bank :'. $e->getMessage());
        }
    }

    public function sendMobileDownloadEmailAction(){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        try{
            $emailTemplateObj = new SendEmailTemplate($this->getServiceLocator());

            $select = "select id, email from customer where mobile_app_downloaded='NO'";

            $result = $adapter->createStatement($select)->execute();
            foreach($result as $customer){

                // put the column name from customer_notification_settings table
                $customerDetailsObj = new CustomerDetails($this->serviceLocator);
                $customer_settings = $customerDetailsObj->getCustomerNotificationSettings('new_deals_or_rewards', $customer['id']);
                if(!$customer_settings){
                    Logger::log("Customer marketing notification is disabled  : ".$customer['id']);
                    continue;
                }
                $emailTemplateObj->sendDownloadMobileAppMail($customer['id'], $reminder=1);
            }
            echo "Mobile reminder sent successfully.";
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        exit;
    }

    public function sendWriteReviewEmailAction(){
        $reviewObj = new MerchantReview($this->getServiceLocator());

        // TO Do : not sending review emails to customers

        $reviewObj->getDetailsToWriteReviewByCustomerForMerchant();
        echo "email and push notification sent for writing a review";
        exit;
    }

    public function procAllDataAction(){
        try{
            $procCallObj = new ProcCall($this->getServiceLocator());
            $procCallObj->procProcessAllDataCall();
        }catch (\Exception $e){
            Logger::log($e->getMessage());
        }
    }

    public function yelpScrapDataAction(){

        $url = "http://yelp.com/biz/";

         $merchantObj = new GlobalMerchant($this->getServiceLocator());
        //  $result = $merchantObj->getMerchantDetailsForConversion();

        // if any global_merchant id provided
        $global_merchant_id = $this->getRequest()->getParam('global_merchant_id');

        // mapping all yipit_global_merchant
       //  $result = $merchantObj->getYipitGlobalMerchantInfo($global_merchant_id);
        $result[] = $merchantObj->getGlobalMerchant($global_merchant_id);

        $i= 1;
        foreach($result as $merchant){

            try{
                // adding google and yelp reviews and images
                // $merchantObj->fetchAndInsertReviewsAndImages($merchant);

                // fetch scraper data
                $scrapper = new \Merchant\V1\Model\Yelp\Scraper();
                $yelp_id = 'the-vude-seattle-3'; //$merchant['yelp_id'];
                $global_merchant_id = 419158; //$merchant['id'];
                $merchant['id'] = 419158;
                if($global_merchant_id == 1){
                    continue;
                }

                $scrapperData = $scrapper->scrape($url.$yelp_id);

                $scrapperData['dollar_range'] = strlen($scrapperData['dollar_range']);

                if(!empty($scrapperData['working_hours']) &&  !$merchant['working_hours']){
                    // working hours
                    $working_hours= null;
                    // var_dump($scrapperData['working_hours']);
                    $merchantTimingsObj = new MerchantTimings($this->getServiceLocator());
                    $working_hours = $merchantTimingsObj->yelpScrapTimingsToFactualTimings($scrapperData['working_hours']);

                    $scrapperData['working_hours'] = json_encode($working_hours);

                    $scrapperData['hours_display'] = $merchantTimingsObj->getDisplayTimingsByTimingString($scrapperData['working_hours']);
                }else{
                    unset($scrapperData['working_hours']);
                }


                $imageLinks = $scrapperData['image_links'];
                unset($scrapperData['image_links']);

                // $scrapperData['about_business'] = $scrapperData['description'];
                unset($scrapperData['description']);

                $additional_info = $scrapperData['additional_info'];

                if(!empty($scrapperData['merchant_url'])){
                    $scrapperData['url'] = $scrapperData['merchant_url'];
                }
                unset($scrapperData['merchant_url']);

                // adding info in global_merchant table ( dollar_range, additional_info, website)
                if(count($scrapperData)){

                    $merchantObj->updateGlobalMerchantData($yelp_id, $global_merchant_id,  $scrapperData);
                    // $merchantObj->updateMerchantDataByGlobalMerchantData($scrapperData, $global_merchant_id);


                }

                // checking if customer falls under Restaurant top level Cateogry id 561
                $restaurntCategory = $merchantObj->isCategoryExistForTopLevelCategoryForMerchant($merchant['id'], 561);

                // check if merchant falls under Hotel top level category id 390
                $hotelCategory = $merchantObj->isCategoryExistForTopLevelCategoryForMerchant($merchant['id'], 390);

                // check if merchant falls under Health and care top level category id 390
                $healthCareCategory = $merchantObj->isCategoryExistForTopLevelCategoryForMerchant($merchant['id'], 251);


                if($restaurntCategory['category_count'] != 0){
                    $merchantObj->addResturantBusinessData($additional_info, $merchant['id']);
                }elseif($hotelCategory['category_count'] != 0){
                    $merchantObj->addHotelsBusinessData($additional_info, $merchant['id']);
                }elseif($healthCareCategory['category_count'] != 0){
                    $merchantObj->addHealthCareBusinessData($additional_info, $merchant['id']);
                }else{
                    $merchantObj->addOthersBusinessData($additional_info, $merchant['id']);
                }

                // updating images
                $merchantObj->addImagesToGlobalMerchantImages($imageLinks, $yelp_id, $global_merchant_id);

                // foreach()
                $updatedMerchant[$merchant['yelp_id']]['message'] = "data update for yelp_id :".$merchant['yelp_id'];
                $updatedMerchant[$merchant['yelp_id']]['data'] = json_encode($scrapperData);

                echo "Updated the info for the yipit merchant .".$merchant['yipit_merchant_id']. "\n";
                sleep(1);
            }catch (\Exception $e){
                Logger::log("unable to get the data for : {$merchant['yelp_id']}".$e->getMessage() );
            }

        }

        echo "Records are updated ";

        return true;

    }

    function xmlGenerationAction(){
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $offset = $this->getRequest()->getParam('offset');

        $file_extension = is_null( $this->getRequest()->getParam('file-extension') )  ? time() : $this->getRequest()->getParam('file-extension');

        // $offset = 0;
        $query = "select if( yelp_id != ''  ,  concat('https://www.privme.com/merchant/', yelp_id) , concat('https://www.privme.com/merchant/', id) ) as url from global_merchant order by id asc limit 20000 offset ".$offset;

        $result = $adapter->createStatement($query)->execute();

        if($result->count()){
            $resultSet = new ResultSet();
            $resultSet->initialize($result);

            $domtree = new \DOMDocument('1.0', 'UTF-8');

            /* create the root element of the xml tree */
            $xmlRoot = $domtree->createElement('urlset');
            $domAttribute = $domtree->createAttribute("xmlns");
            $domAttribute->value = "http://www.sitemaps.org/schemas/sitemap/0.9";
            $xmlRoot->appendChild($domAttribute);
            /* append it to the document created */
            $xmlRoot = $domtree->appendChild($xmlRoot);

            foreach($resultSet as $result){
                if($result['url'] != ""){
                    $currentTrack = $domtree->createElement("url");
                    $currentTrack = $xmlRoot->appendChild($currentTrack);

                    $xmlRoot = $domtree->appendChild($xmlRoot);
                    $currentTrack->appendChild($domtree->createElement('loc',$result['url']));
                    $currentTrack->appendChild($domtree->createElement('lastmod',date('Y-m-d', time())));
                    $currentTrack->appendChild($domtree->createElement('changefreq','daily'));
                    $currentTrack->appendChild($domtree->createElement('priority','0.5'));
                }else{
                    Logger::log(' Unknown urls'. $result['id'] );
                }
            }

            $domtree->xmlEncoding;
            $domtree->xmlVersion;
            $domtree->formatOutput = true;
            $domtree->save("test{$file_extension}.xml");
        }
    }

    function procAllDataForCustomerAction(){
        try{
            $customer_id = $this->getRequest()->getParam('customer_id');
            $procCallObj = new ProcCall($this->getServiceLocator());
            $procCallObj->procProcessAllDataCallForCustomer($customer_id);
        }catch (\Exception $e){
            Logger::log($e->getMessage());
        }
    }

    function yipitMerchantMappingAction(){
        $yipitMerchantModel = new YipitMerchant($this->getServiceLocator());

        $yipit_merchant = $this->getRequest()->getParam('yipit-merchant');
        // mapping the Yipit Merchant with global_merchant_id by query
        // $yipitMerchantModel->mapYipItMerchantWithQuery();

        // mapping unmatched merchants
        // get the yipit merchant by yipit id

        if($yipit_merchant){

            $YipitMerchants[] = $yipitMerchantModel->getDataByYipitMerchantId($yipit_merchant);

        }else{
            $YipitMerchants = $yipitMerchantModel->getYipitMerchant();
        }

        ;
        if($YipitMerchants){

            foreach($YipitMerchants as $merchant){

                try{

                    $yipitMerchantModel->yipItMechantMapping($merchant);

                }catch(\Exception $e){

                    Logger::log('Yipit Merchant Mapping :'.$e->getMessage());

                }

            }
        }
    }

    public function sendMerchantCodeMailAction(){
        // get Merchant Details
        $merchantObj = new Merchant($this->serviceLocator);

        $merchant_user_id = $this->getRequest()->getParam('merchant-user-id');

        $queryString = $merchantObj->getQueryForMerchantCode($merchant_user_id);
        $merchants = $merchantObj->executeDbQueries($queryString);

        foreach($merchants as $merchant){
            try{
                $sendEmailTemplateObj = new SendEmailTemplate($this->getServiceLocator());
                $sendEmailTemplateObj->sendMerchantCodeEmailAlert($merchant);
            }catch(\Exception $e){
                Logger::log("Send Merchant Code Error : ".$e->getMessage());
            }
        }

        echo "Merchant Code Email sent Successfully to all merchants.";
    }

    public function updateMerchantSpecialTextAction(){
        $global_merchant_identifier = $this->getRequest()->getParam('global-merchant-identifier');

        $review_identifier = $this->getRequest()->getParam('review-identifier');

        $id = $this->getRequest()->getParam('id');

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        if($global_merchant_identifier){
            echo "updating snippet text... \n";
            $selectQuery = "select id, snippet_text from global_merchant";

            // if id is present
            if($id){
                $selectQuery .= " where id={$id}";
               // echo $selectQuery."\n";
                try{
                    $result = $adapter->createStatement($selectQuery)->execute()->current();

                    if(!$this->isJson($result['snippet_text'])) {

                        $updateQuery = "update global_merchant set snippet_text='" .  $this->form_safe_json(json_encode($result['snippet_text'])) . "' where id={$result['id']}";
                        // echo $updateQuery;exit;
                        $adapter->createStatement($updateQuery)->execute();
                        echo "Snippet text is updated for id : {$id} \n";

                    }else{
                        echo "Already updated in json formated for id : {$result['id']} \n";
                    }

                   // echo "Snippet text is updated for id : {$id} \n";
                }catch(\Exception $e){
                    Logger::log("Snippet Text Db error : ".$e->getMessage());
                }


                return true;
            }

            try{
                $results = $adapter->createStatement($selectQuery)->execute();
                if($results->count()){
                    foreach($results as $result){
                        if(!$this->isJson($result['snippet_text'])){
                            $updateQuery = "update global_merchant set snippet_text='". $this->form_safe_json(json_encode($result['snippet_text'])). "' where id={$result['id']}";

                            $adapter->createStatement($updateQuery)->execute();

                            echo "Snippet text is updated for id : {$result['id']} \n";
                        }else{
                            echo "Already updated in json formated for id : {$result['id']} \n";
                        }
                    }
                    return true;
                }

            }catch(\Exception $e){
                Logger::log("Snippet Text Db error : ".$e->getMessage());
            }

        }elseif($review_identifier){
            echo "updating review text... \n";
           //  $selectQuery = "select global_merchant_id, content, id from global_merchant_reviews";
            $selectQuery = "select global_merchant_id, content, id  from global_merchant_reviews where locate('\"', content) != 1 and content != ''";
           // echo $selectQuery;
           // exit;
            // if id is present
            if($id){
                $selectQuery .= " where global_merchant_id={$id}";

                try{
                    $results = $adapter->createStatement($selectQuery)->execute();

                    if($results->count()){
                        foreach($results as $result){
                            if(!$this->isJson($result['content'])) {
                                $updateQuery = "update global_merchant_reviews set content='" .  $this->form_safe_json(json_encode($result['content'])) . "' where id={$result['id']}";
                                $adapter->createStatement($updateQuery)->execute();
                                echo "Review content is updated for global_merchant_id : {$id} \n";

                            }else{
                                echo "Already updated in json formated for global_merchant_id : {$result['global_merchant_id']} \n";
                            }
                        }
                    }

                    // echo "Snippet text is updated for id : {$id} \n";
                }catch(\Exception $e){
                    Logger::log("review content Text Db error : ".$e->getMessage());
                }


                return true;
            }

            try{
                $results = $adapter->createStatement($selectQuery)->execute();
                if($results->count()){
                    foreach($results as $result){
                        if(!$this->isJson($result['content'])){
                            $updateQuery = "update global_merchant_reviews set content='". $this->form_safe_json(json_encode($result['content'])). "' where id={$result['id']}";

                            $adapter->createStatement($updateQuery)->execute();

                            echo " Review content updated for id: {$result['id']} \n";
                        }else{
                            echo "Already updated in json formated for global_merchant_id: {$result['id']} \n";
                        }
                    }
                    return true;
                }

            }catch(\Exception $e){
                Logger::log("Snippet Text Db error : ".$e->getMessage());
            }


        }
    }

    public function activateBackgroundProcessAction()
    {
        $identifier = $this->getRequest()->getParam('identifier');

        $host = $_SERVER['HTTP_HOST'];

      //  if (strstr($host, 'privpass.com') || strstr($host, 'privme.com')) {
            switch ($identifier) {
                case (1) :
                    // for restaurant merchant mapping
                    $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php  restaurant-merchant-mapping  >> /tmp/restaurant-merchant-mapping.log & printf "%u" $!';
                    echo $cmd;
                    $pid = shell_exec($cmd);
                    echo $pid;
            break;
            case
                (2) :
                    // for Yipit merchant mapping
                    $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php yipit-merchant-mapping  >> /tmp/yipit-merchant-mapping.log & printf "%u" $!';
                    echo $cmd;
                    $pid = shell_exec($cmd);
                    echo $pid;
                    break;
            case
                (3) :
                    // for Yipit merchant mapping
                    $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php proc-add-global-merchant-fulltext  > /tmp/proc-add-global-merchant-fulltext.log & printf "%u" $!';
                    echo $cmd;
                    $pid = shell_exec($cmd);
                    echo $pid;
                    break;
            case
                (4) :
                    // for fetching data for yipit merchants
                    $cmd = 'nohup nice -n 10 /usr/bin/php -f ' . APPLICATION_PATH . '/zf.php yelp-scrap-data  >> /tmp/yelp-scrap-data.log & printf "%u" $!';
                    echo $cmd;
                    $pid = shell_exec($cmd);
                    echo $pid;
                    break;
            default :
                echo "No Identifier selected to activate background job";
            }
      //  }
    }

    public function restaurantMerchantMappingAction(){

        $restaurantMerchantModel = new RestaurantMerchant($this->getServiceLocator());

        $restaurant_id = $this->getRequest()->getParam('identifier');
        // mapping the Yipit Merchant with global_merchant_id by query
        $restaurantMerchantModel->mapRestaurantMerchantWithQuery();

        // mapping unmatched merchants
        // get the yipit merchant by yipit id

        if($restaurant_id){

            $restaurantMerchants[] = $restaurantMerchantModel->getDataByRestaurantMerchantId($restaurant_id);

        }else{
            $restaurantMerchants = $restaurantMerchantModel->getRestaurantMerchants();
        }

        if($restaurantMerchants){

            foreach($restaurantMerchants as $merchant){

                try{

                    $restaurantMerchantModel->restautantMechantMapping($merchant);

                }catch(\Exception $e){

                    Logger::log('Yipit Merchant Mapping :'.$e->getMessage());

                }

            }
        }

    }
    function fetchTransactionsAndAnalyzeFinicityTransacAction(){
        $option = $this->getRequest()->getParam('option');

        $model = new \Finicity\V1\Model\TransactionsFetch($this->getServiceLocator());
        $model->fetchTransactionsAndAnalyze();

        if ($option == 'sendEmail') {
            $emailSender = new EmailSender($this->getServiceLocator());
            $emailSender->emailUnmappedTransactions();
        }

        $message = 'fetch-transactions-and-analyze';
        Logger::log($message);

        echo $message . ' at ' . date('Y-m-d H:i:s');
        exit;
    }

    function isJSON($str=NULL) {
        if (is_string($str)) {
            @json_decode($str);
            return (json_last_error() === JSON_ERROR_NONE);
        }
        return false;
    }

    function form_safe_json($json) {
        $json = empty($json) ? '[]' : $json ;
        $search = array('\\',"\n","\r","\f","\t","\b","'") ;
        $replace = array('\\\\',"\\n", "\\r","\\f","\\t","\\b", "\\'");
        $json = str_replace($search,$replace,$json);
        return $json;
    }

    function procAddGlobalMerchantFulltextAction(){
        $procObj = new MysqlProcedureCall($this->serviceLocator);

        return $procObj->AddGlobalMerchantFulltext();
    }

    /**
     * @summary sending weekly summary to merchant
     */
    function merchantWeeklySummaryAction(){
        $sendEmailNotificationObj = new SendEmailNotification($this->serviceLocator);

        $merchant_id = $this->getRequest()->getParam('merchant_id');

        $sendEmailNotificationObj->getWeeklySummary($merchant_id);

        echo "Email sent successfully";
    }

    /**
     * @summary new cashback received checked based on the table 'customer_cashback_log' and checking the column 'is_notification_sent'
     */

    function cashbackReceivedEmailAndNotificationAction(){

        $cashbackObj = new CustomerCashback($this->getServiceLocator());


        $extra_params['global_merchant_id'] = $this->getRequest()->getParam('global_merchant_id');
        $extra_params['customer_id'] = $this->getRequest()->getParam('customer_id');
        $cashbackLogData = $cashbackObj->getCustomerForNewCashbackReceived($extra_params);


        try{
            if(count($cashbackLogData)< 1 ) throw new \Exception("New cashback not found any customer");

            $pushNotificationObj = new PushNotification($this->getServiceLocator());
            $sendEmailTemplateObj    = new SendEmailTemplate($this->getServiceLocator());
            foreach($cashbackLogData as $data){

                // put the column name from customer_notification_settings table
                $customerDetailsObj = new CustomerDetails($this->serviceLocator);
                $customer_settings = $customerDetailsObj->getCustomerNotificationSettings('new_deals_or_rewards', $data['customer_id']);
                if(!$customer_settings){
                    Logger::log("Customer marketing notification is disabled for cashback summary : ".$data['customer_id']);
                    continue;
                }
                // send push notification
                $pushNotificationObj->NewCashbackReceivedNotification($data);

                // send notification email
                $sendEmailTemplateObj->sendNewCashbackReceivedEmail($data);

                // update the notification status for customer
                 $cashbackObj->updateCashbackLog($data['id']);
            }


        }catch (\Exception $e){

            Logger::log("New Cashback error :".$e->getMessage());
            echo $e->getMessage();
        }


    }

    public function weeklyCashbackSummaryAction(){
        // peramters available
        $global_merchant_id = $this->getRequest()->getParam('global_merchant_id');
        $customer_id = $this->getRequest()->getParam('customer_id');

        // send weekly summary template
        $sendEmailObj = new SendEmailNotification($this->getServiceLocator());
        $sendEmailObj->sendWeeklyCashbackSummaryToCustomer($customer_id);
    }

    public function weeklyDealSummaryAction(){
        $customer_id = $this->getRequest()->getParam('customer_id');

        $sendEmailTemplateObj = new SendEmailNotification($this->getServiceLocator());

        $sendEmailTemplateObj->sendDealSummaryWeeklyEmail($customer_id);
    }

    public function weeklySuggestedDealsAction(){

        $customer_id = $this->getRequest()->getParam('customer_id');

        $sendEmailTemplateObj = new SendEmailNotification($this->getServiceLocator());

        $sendEmailTemplateObj->sendSuggestedDealsEmail($customer_id);
    }

    public function testNotificationAction(){
        $customer_id = $this->getRequest()->getParam('customer_id');
        $global_merchant_id = $this->getRequest()->getParam('global_merchant_id');

        $pushNotificationObj = new PushNotification($this->getServiceLocator());
        $cashbackData = [];

        /*$cashbackData['first_name'] = "Lakshmi";
        $cashbackData['last_name'] = "Kodali";
        $cashbackData['sum'] = 23.00;
        $cashbackData['id'] = $customer_id;
        $cashbackData['global_merchant_id'] = $global_merchant_id;*/

        $cashbackData['customer_id'] = $customer_id;
       //  $cashbackData['global_merchant_id'] = $global_merchant_id;
        // for write a review
        //  $cashbackData['extra_parameters'] = array('type'=>'REVIEW_MERCHANT','merchant_id'=>'5476');

        // for bank link card
        //$cashbackData['extra_parameters'] = array('type'=>'CARDS_LINK');

        // for review App
         $cashbackData['extra_parameters'] = array('type'=>'REVIEW_APP');
        // $pushNotificationObj->testNotification($cashbackData);
         // $pushNotificationObj->testNotificationForReview($cashbackData);
         // $pushNotificationObj->testNotificationForCardLink($cashbackData);
         $pushNotificationObj->testNotificationForReviewApp($cashbackData);
    }

    public function fetchTransactionsAndAnalyzeFinicityDirectAction(){

        $option = $this->getRequest()->getParam('option');

        $customer_id = $this->getRequest()->getParam('customer_id');

        $model = new \Intuit\V1\Model\TransactionFetchFinicityDirect($this->getServiceLocator());
        $model->fetchTransactionsAndAnalyze($customer_id);

        if ($option == 'sendEmail') {
            $emailSender = new EmailSender($this->getServiceLocator());
            $emailSender->emailUnmappedTransactions();
        }

        $message = 'fetch-transactions-and-analyze';
        Logger::log($message);

        echo $message . ' at ' . date('Y-m-d H:i:s');
        exit;
    }
}
