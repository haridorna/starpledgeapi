<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Admin\Model\Auth;
use Admin\Model\BulkMerchantDescriptionMap;
use Admin\Model\BusinessesWithoutGooglePlace;
use Admin\Model\Customers;
use Admin\Model\DollarValues;
use Admin\Model\GlobalMerchantGooglePlace;
use Admin\Model\MerchantDescriptionMap;
use Admin\Model\MerchantMap;
use Admin\Model\Merchants;
use Admin\Model\TransactionDescripiton;
use Application\Auth\Cipher;
use Common\Tools\Password;
use GlobalMerchant\V1\Model\Google\GooglePlace;
use Merchant\V1\Model\GlobalMerchant\GlobalMerchant;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Merchant\V1\Model\Yelp\Yelp;

/**
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $auth = new Auth($this->getServiceLocator());
        $user = $auth->isLoggedIn();
        if (!$user) {
            return $this->redirect()->toRoute('admin-login');
        }

        $bank  = new MerchantMap($this->getServiceLocator());
        $banks = $bank->getBankList();

        return ['banks' => $banks, 'user' => $user];
    }

    public function processMerchantAction()
    {
        $post = $this->getRequest()->getPost();
        $map  = new MerchantDescriptionMap($this->getServiceLocator());
        $map->mapMerchant($post);

        return $this->redirect()->toRoute('admin');
    }

    public function wrongMappingAction()
    {
        $map    = new MerchantDescriptionMap($this->getServiceLocator());
        $result = $map->getWrongMappingList();

        return ['wrongMapping' => $result];
    }

    public function wrongLocationAction()
    {
        $map    = new MerchantDescriptionMap($this->getServiceLocator());
        $result = $map->getWrongLocationList();

        return ['wrongMapping' => $result];
    }

    public function hideBusinessAction()
    {
        $map    = new MerchantDescriptionMap($this->getServiceLocator());
        $result = $map->getHideBusinessList();

        return ['wrongMapping' => $result];
    }


    public function neverShowBusinessAction()
    {
        $map    = new MerchantDescriptionMap($this->getServiceLocator());
        $result = $map->getNeverShowBusinessList();

        return ['wrongMapping' => $result];
    }

    public function fetchDescriptionsAction()
    {
        $bankId       = $this->getRequest()->getQuery('bankId');
        $categoryName = $this->getRequest()->getQuery('categoryName');

        $merchantMap  = new MerchantMap($this->getServiceLocator());
        $descriptions = $merchantMap->getDescriptions($bankId, $categoryName);

        return new JsonModel($descriptions);
    }

    public function fetchCategoriesAction()
    {
        $merchantMap = new MerchantMap($this->getServiceLocator());
        $bankId      = $this->params()->fromQuery('bankId');

        $categories = $merchantMap->getCategoriesByBank($bankId);

        return new JsonModel($categories);
    }

    public function businessesWithoutGooglePlaceAction()
    {
        $model = new BusinessesWithoutGooglePlace($this->getServiceLocator());

        $businesses = $model->fetchBusinesses();

        return new JsonModel($businesses);
    }

    public function getGooglePlacesAction()
    {
        $term     = $this->getRequest()->getQuery('term');
        $location = $this->getRequest()->getQuery('location');

        $googlePlace = new GooglePlace($this->getServiceLocator());
        $places      = $googlePlace->findGooglePlaces($term, $location);

        $retArr = [];
        if (is_array($places)) {
            foreach ($places as $item) {
                $item['coords']  = implode(',', @$item['geometry']['location']);
                $item['address'] = @$item['formatted_address'];

                $retArr[] = $item;
            }
        }

        return new JsonModel($retArr);
    }

    public function fetchBanksAction()
    {
        $item        = $this->getRequest()->getQuery('item');
        $description = new TransactionDescripiton($this->getServiceLocator());
        $banks       = $description->fetchBanks($item);

        return new JsonModel($banks);
    }

    public function createPasswordAction()
    {
        $passwordTxt = $this->getRequest()->getQuery('password');

        $salt     = Password::createSalt();
        $password = Password::createPassword($salt, $passwordTxt);

        echo '<pre>';
        print_r([
            'salt'     => $salt,
            'password' => $password
        ]);
        exit;
    }

    public function loginAction()
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $auth     = new Auth($this->getServiceLocator());
            $username = $this->getRequest()->getPost('username');
            $password = $this->getRequest()->getPost('password');
            $result   = $auth->login($username, $password);

            if ($result) {
                return $this->redirect()->toRoute('admin');
            }
        }

        $viewModel = new ViewModel();
        $viewModel->setTerminal(TRUE);

        return $viewModel;
    }

    public function logoutAction()
    {
        $auth = new Auth($this->getServiceLocator());
        $user = $auth->isLoggedIn();
        if ($user) {
            $auth->logout();
        }

        return $this->redirect()->toRoute('admin-login');
    }

    public function merchantsAction()
    {
        $auth = new Auth($this->getServiceLocator());
        $user = $auth->isLoggedIn();
        if (!$user) {
            return $this->redirect()->toRoute('admin-login');
        }

        $page = $this->getEvent()->getRouteMatch()->getParam('page', 1);

        $merchant  = new Merchants($this->getServiceLocator());
        $merchants = $merchant->getMerchantList($page);
        $paginator = $merchant->getPaginator($page);

        return ['merchants' => $merchants, 'user' => $user, 'paginator' => $paginator];
    }

    public function customersAction()
    {
        $auth = new Auth($this->getServiceLocator());
        $user = $auth->isLoggedIn();
        if (!$user) {
            return $this->redirect()->toRoute('admin-login');
        }

        $page = $this->getEvent()->getRouteMatch()->getParam('page', 1);

        $customer  = new Customers($this->getServiceLocator());
        $customers = $customer->getCustomerList($page);
        $paginator = $customer->getPaginator($page);

        return ['customers' => $customers, 'user' => $user, 'paginator' => $paginator];
    }

    public function saveGooglePlaceAction()
    {
        if ($this->getRequest()->getMethod() == 'POST') {
            $data = $this->getRequest()->getPost();

            $googlePlace = new GlobalMerchantGooglePlace($this->getServiceLocator());
            $googlePlace->save($data);

            return new JsonModel(["message" => "Success"]);
        }

        return new JsonModel(["message" => "No action done"]);
    }

    /**
     * Function: dealScraperAction
     * @author   Hari Dornala
     * @return array
     * @route    admin/index/deal-scraper
     */
    public function dealScraperAction()
    {
        $deal    = [];
        $scraper = new \Admin\Model\GrouponScraper($this->getServiceLocator());

        if ($this->getRequest()->getMethod() == 'POST') {
            $post = $this->getRequest()->getPost();
            $deal = $scraper->scrape($post);

            return new JsonModel($deal);
        }

        $merchants = $scraper->getMerchantList();

        return ['merchants' => $merchants];
    }

    public function createMerchantAction()
    {
        $message = FALSE;
        if ($this->getRequest()->getMethod() == 'POST') {
            $yelpId           = $this->getRequest()->getPost('yelp_id');
            $merchant         = new \Admin\Model\MerchantDescriptionMap($this->getServiceLocator());
            $globalMerchantId = $merchant->createGlobalMerchant($yelpId);

            $factual = new \GlobalMerchant\V1\Model\Factual\FactualData(
                $this->getServiceLocator(), $yelpId, $globalMerchantId
            );

            $factual->process();

            if ($globalMerchantId) {
                $message          = new \StdClass();
                $message->message = "Merchant Successfully created";
                $message->class   = 'alert-success';
            } else {
                $message          = new \StdClass();
                $message->message = "Sorry, Failed to create Merchant";
                $message->class   = 'alert-danger';
            }
        }

        return ['message' => $message];

    }

    public function dummyAction()
    {
        echo "New Server Setup Done!";
        exit;
        $db      = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new \Zend\Db\TableGateway\TableGateway('nearby_customers1', $db, new RowGatewayFeature('id'));
        $result  = $gateway->select();

        $records = [];
        if (($handle = fopen("F:\PrivPASS\customerdata1.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                $t  = $data[17];
                $t  = explode(',', $t);
                $t1 = [];
                foreach ($t as $item) {
                    $t1[] = explode('|', $item);
                }

                $records[] = json_encode($t1);
            }
            fclose($handle);
        }

        foreach ($result as $key => $item) {
            $item->transaction_details = $records[$key];
            $item->save();
        }

        echo 'done';

        exit;
    }

    public function saveDealAction()
    {
        $post    = $this->getRequest()->getPost();
        $scraper = new \Admin\Model\GrouponScraper($this->getServiceLocator());
        $scraper->saveDeal($post);

        return $this->redirect()->toUrl('/admin/index/deal-scraper');
    }

    /**
     * Function: addDollarsAction
     *
     * Scrapes and updates dollar values to all merchants.
     *
     * @author   Hari Dornala
     */
    public function addDollarsAction()
    {
        $dollarValues = new DollarValues($this->getServiceLocator());
        $dollarValues->process();
        echo "Done";
        exit;
    }

    public function loadGoogleDataAction()
    {
        $globalMerchant = new GlobalMerchant($this->getServiceLocator());
        $globalMerchant->loadDataToMerchants();
        echo "Done";
        exit;
    }

    public function addVipPrivilegesAction()
    {
        $db      = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new \Zend\Db\TableGateway\TableGateway('nearby_customers', $db, new RowGatewayFeature('id'));

        $result = $gateway->select();

        foreach ($result as $item) {
            $sql = "SELECT DISTINCT(option_text), option_icon_url
				FROM service_options_master
				WHERE option_type != 'custom'
				ORDER BY RAND() LIMIT " . rand(0, 9);

            $statement      = $db->createStatement($sql, array());
            $serviceOptions = $statement->execute();

            $options = [];
            foreach ($serviceOptions as $option) {
                $option['option_icon_url'] = 'https://biz.privpass.com/massets/images/service-options/' . $option['option_icon_url'];
                $options[]                 = $option;
            }

            $options = json_encode($options);

            $item->vip_privileges = $options;
            $item->save();

        }

        echo 'done';
        exit;
    }

    public function addParentCategoryAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('business_category', $adapter, new RowGatewayFeature('id'));


        $result = $gateway->select();
        foreach ($result as $item) {
            if ($item->level == 1) {
                $item->top_level_category_name = $item->name;
                $item->save();
                continue;
            } else {
                $item->top_level_category_name = $this->getToplevelCategory($item, $item->id);
                $item->save();
            }
        }

        echo 'done';
        exit;
    }

    public function getToplevelCategory($item, $id)
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('business_category', $adapter);
        if ($item->level == 2) {
            $row = $gateway->select(['id' => $item->parent_id])->current();

            return $row->name;
        }
        if ($item->level == 3) {
            $row = $gateway->select(['id' => $item->parent_id])->current();
            $row = $gateway->select(['id' => $row->parent_id])->current();

            return $row->name;
        }
    }

    public function showAddOnlineMerchantFormAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $sql     = "SELECT id, disp_name
                FROM business_category
                WHERE `level`!= 1;
                ORDER BY name";

        $statement  = $adapter->createStatement($sql, []);
        $result     = $statement->execute();
        $categories = iterator_to_array($result);
        $result->getResource()->closeCursor();
        $gateway        = new TableGateway('business_category', $adapter);
        $categoryResult = $gateway->select(['name' => 'OnlineShopping']);

        if ($categoryResult->count()) {
            $categoryId = $categoryResult->current()->id;
        } else {
            $categoryId = '';
        }

        $viewModel = new ViewModel([
            'categories'        => $categories,
            'defaultCategoryId' => $categoryId
        ]);

        $viewModel->setTerminal(TRUE);

        return $viewModel;
    }

    public function searchMerchantAction()
    {
        $request = $this->getRequest();

        if (!$request->isPost()) {
            return [];
        }

        $data = $request->getContent();
        $data = json_decode($data);

        if (!isset($data->business_address) || $data->business_address == '') {
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $sql     = "SELECT *
                    FROM global_merchant
                    WHERE `name` LIKE '%" . $data->business_name . "%'";

            $statement = $adapter->createStatement($sql, []);
            $result    = $statement->execute();

            $merchants = [];
            foreach ($result as $item) {
                $categories = $item['categories'];

                if (is_array($categories)) {
                    foreach ($categories as $each) {
                        $item['categories'][] = $each[0];
                    }
                } else {
                    $item['categories'] = [];
                }

                $merchants[] = $item;
            }

            return new JsonModel([
                'total'      => count($merchants),
                'businesses' => $merchants
            ]);
        }

        $serviceLocator = $this->getServiceLocator();
        $yelp           = new Yelp($serviceLocator);

        $yelpData = $yelp->getYelpData($data->business_name, $data->business_address);

        return new JsonModel($yelpData);
    }

    public function saveMerchantAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('global_merchant', $adapter);

//        echo '<pre>'; print_r($_POST); exit;
        $gateway->insert([
            'name'            => $_POST['name'],
            'url'             => $_POST['url'],
            'is_online_store' => 1,
            'rating'          => $_POST['rating'],
            'review_count'    => $_POST['review_count'],
            'snippet_text'    => $_POST['snippet_text'],
            'display_phone'   => $_POST['display_phone'],
            'city'            => $_POST['city'],
            'about_business'  => $_POST['about_business'],
            'working_hours'   => $_POST['working_hours'],
            'hours_display'   => $_POST['hours_display'],
            'additional_info' => $_POST['additional_info'],
            'dollar_range'    => $_POST['dollar_range']
        ]);

        $globalMerchantId = $gateway->getLastInsertValue();

        if ($globalMerchantId) {
            $set    = "`global_merchant_id`, `Category1`";
            $values = "$globalMerchantId, {$_POST['category'][0]}";

            if (!empty($_POST['category'][1])) {
                $set .= ',' . '`Category2`';
                $values .= ',' . $_POST['category'][1];
            }

            if (!empty($_POST['category'][2])) {
                $set .= ',' . '`Category3`';
                $values .= ',' . $_POST['category'][2];
            }

            $sql = "INSERT INTO `global_business_categories` ($set) VALUES ($values)";

            $statement = $adapter->createStatement($sql);
            $statement->execute();

            $sql = "SELECT *
                    FROM global_merchant
                    WHERE `id` = ?";

            $statement = $adapter->createStatement($sql, [$globalMerchantId]);
            $result    = $statement->execute();
            $merchant  = $result->current();

            $sql = "SELECT disp_name
                    FROM business_category
                    WHERE id IN ($values) ORDER BY id DESC";

            $statement = $adapter->createStatement($sql, []);
            $result    = $statement->execute();

            $categories = [];
            foreach ($result as $item) {
                $categories[] = $item['disp_name'];
            }

            $merchant['categories'] = $categories;

            return new JsonModel([
                'result'     => 'success',
                'total'      => 1,
                'businesses' => [$merchant]
            ]);
        }

        return new JsonModel([
            'result' => 'error'
        ]);
    }

    public function saveIgnoredDescriptionAction()
    {
        $description = $this->params()->fromQuery('description');
        $status = $this->params()->fromQuery('status');
        $notes = $this->params()->fromQuery('notes');

        if (!$description) {
            return new JsonModel([
                'result'  => 'error',
                'message' => 'Description not found'
            ]);
        }

        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $gateway = new TableGateway('intuit_customer_transaction', $adapter);

        $gateway->update(['ignoreFlag' => 1, 'mappingStatus' => $status, 'mappingNotes' => $notes], ['payeeName' => $description]);

        return new JsonModel([
            'result'  => 'success',
            'message' => 'Successfully updated'
        ]);
    }

    public function removeDescriptionsAction()
    {
        $description = $this->params()->fromQuery('description');
        $adapter     = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $sql = 'INSERT IGNORE INTO intuit_customer_transaction_other_categories (customerId,transactionId,bankId,bankAgencyId,accountId,  bankTransactionId,serverTransactionId,checkNumber,refNumber,confirmationNumber,payeeId,payeeName,extendedPayeeName,memo, `type`,currencyType,currencyRate,originalCurrency,postedDate,userDate,availableDate,amount,runningBalanceAmount,pending,merchantName,purchaseCategory,merchantCategories,categoryFlag,globalMerchantId)
        SELECT customerId,transactionId,bankId,bankAgencyId,accountId,bankTransactionId,serverTransactionId,checkNumber,refNumber,confirmationNumber,payeeId,payeeName,extendedPayeeName,memo, `type`,currencyType,currencyRate,originalCurrency,postedDate,userDate,availableDate,amount,runningBalanceAmount,pending,merchantName,purchaseCategory,merchantCategories,categoryFlag,globalMerchantId
        FROM intuit_customer_transaction
        WHERE payeeName = :description';

        $statement = $adapter->createStatement($sql, ['description' => $description]);
        $statement->execute();

        $sql = 'DELETE
                FROM intuit_customer_transaction
                WHERE payeeName = :description';

        $statement = $adapter->createStatement($sql, ['description' => $description]);
        $statement->execute();

        return $this->redirect()->toRoute('admin');
    }

    public function scriptsAction()
    {
        return [];
    }

    public function runBulkUploadAction()
    {
        $map = new BulkMerchantDescriptionMap($this->getServiceLocator());
        echo json_encode($map->process());
        exit;
    }

    public function decryptAction()
    {
        $value = $this->params()->fromQuery('value');

        $crypt = new Cipher();
        echo $crypt->decrypt($value);
        exit;
    }
}
