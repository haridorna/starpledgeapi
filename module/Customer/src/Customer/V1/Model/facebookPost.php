<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 9/2/2015
 * Time: 5:40 PM
 */

namespace Customer\V1\Model;

use Facebook\FacebookRequest;
use Facebook\FacebookSession;
use BaseFacebook;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\V1\Model\FacebookFeed;
use FacebookApiException;
use Facebook\HttpClients\FacebookStream;
use Zend\Db\TableGateway\TableGateway;

class facebookPost{

    private $serviceLocator ;
    protected $redirectUrl;
    protected $appId;
    protected $appSecret;

    function __construct($serviceLocator){
        $this->serviceLocator = $serviceLocator;
        $config = $this->serviceLocator->get('config');
        $this->appId = $config['facebook']['app_id'];
        $this->appSecret = $config['facebook']['app_secret'];
        $this->redirectUrl = $config['facebook']['redirect_url'];
        $this->setFacebookApplication();
      //  $facebook = new FacebookFeed()

    }

    protected function setFacebookApplication()
    {
        FacebookSession::setDefaultApplication($this->appId, $this->appSecret);
    }

    public function facebookPost($customer_id,$content){
        $adapter        =   $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
        $customerTable  =   new TableGateway("customer", $adapter);
        $customer       =   $customerTable->select(array('id'=>$customer_id))->current();

        // login helper with redirect_uri
        $session = new FacebookSession($customer['facebook_access_token']);

        $content = "this is facebook post content";

      //  $data = file_get_contents('http://graph.facebook.com/4'); print_r( $data );
      /*  try {
            if (!$session->validate()) {
                $session = NULL;
            }
        } catch (\Exception $e) {
            // catch any exceptions
            $session = NULL;
        }*/

        $request  = new FacebookRequest($session, 'POST', '/me/feed', array(
            'message'     => 'Signup with PrivMe to get abundant personalised deals!',
            'picture'     => "http://vignette3.wikia.nocookie.net/strider/images/3/34/Strider2_hiryu_profile.png/revision/latest?cb=20150420152958",
            'type' => 'status',
            'link'        => 'privpass.lad.com',
            'description' => 'PrivPass analyzes your spending habits and provides you with the best deals suitable to you!'
        ));
        $response = $request->execute();
        $result = $response->getGraphObject()->asArray();

        return $result;
    }
}