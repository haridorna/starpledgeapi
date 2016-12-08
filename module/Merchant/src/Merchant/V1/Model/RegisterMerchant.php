<?php

/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 9/23/14
 * Time: 6:47 PM
 */

namespace Merchant\V1\Model;

use Common\Tools\Util;
use Common\V1\Model\TinyUrl;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Common\Tools\Password;
use Common\V1\Model\Mail\Mandrill\Mail;
use Common\V1\Model\Mail\Mandrill\Message;
use Zend\Text\Table\Table;

/**
 * Class RegisterMerchant
 *
 * @package Merchant\V1\Model
 */
class RegisterMerchant {

    private $serviceLocator;
    private $dbAdapter;
    private $response = [];
    private $error = [];
    private $status = 200;
    private $tblMerchant;
    private $tblMerchantUser;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        $this->dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $this->tblMerchantUser = new TableGateway('merchant_user', $this->dbAdapter);
        $this->tblMerchant = new TableGateway('merchant', $this->dbAdapter);
    }

    public function register($data) {
        if (!isset($data["merchant_data"])) {
            return $this->register_merchant($data);
        } else {
            return $this->register_business($data);
        }
    }

    private function register_business($data) {

        $conn = $this->dbAdapter->getDriver()->getConnection();

        // if global_merchant is not available then create record in global merchant table
        if(!isset($data['global_merchant_id'])){
            $data['global_merchant_id'] = $this->addGlobalMerchant($data);
        }

        $data["business_categories"][0] = isset($data["business_categories"][0]) ? $data["business_categories"][0] : 561 ;

        if ($this->invalidData($data)) {
            echo "this is error";
            return;
        }

        $conn->beginTransaction();

        try {
            $merchantId = $this->addMerchant($data);
            $merchantUserId = $data["merchant_data"]["merchant_user_id"];

            $this->addMerchantUserMap($merchantId, $merchantUserId);

            $conn->commit();
			//send welcome email to merchant email
			$this->sendWelcomeEmail($data["business_email"],$data["business_name"]);
            $this->sendAdminEmailAlert($data, $function_type='add_business');
			
        } catch (\Exception $e) {
            //$this->error[] = 'Unable to save Merchant with Error: ' . $e->getMessage();
            // $this->error[] = 'Merchant with this Email ID already exists';
            $this->error[] = 'Unable to save Merchant with Error: ' . $e->getMessage();
            $this->status = 422;
            //$conn->rollback();
        }

        if (count($this->error) == 0) {
			// this part is added to match the data as returned by Merchant login service
            //$mdata = $this->dbAdapter->createStatement("select (select business_name from merchant where id = " . $data["merchant_data"]["merchant_id"] . ")as business_name, mu.* from merchant_user mu where mu.email = '" . $data["email_id"] . "'")->execute()->current();			
            if(isset($data['global_merchant_id'])){
                $sql = "select m.global_merchant_id,m.id as merchant_id, mm.level as employee_type, m.business_name,m.email, m.address1, m.address2, m.city, m.state, m.zip, gm.image_url as image_url, mu.invitation_token, (select count(*) from merchant_campaigns where merchant_id = ".$merchantId.") as num_campaigns  from merchant m, merchant_user_map mm, global_merchant gm, merchant_user mu where mu.id=" . $merchantUserId." and m.id=". $merchantId." and m.id = mm.merchant_id and m.global_merchant_id = gm.id and mu.id = mm.merchant_user_id";
            }else{
                $sql = "select m.global_merchant_id,m.id as merchant_id, mm.level as employee_type, m.business_name,m.email, m.address1, m.address2, m.city, m.state, m.zip, mu.invitation_token, (select count(*) from merchant_campaigns where merchant_id = ".$merchantId.") as num_campaigns  from merchant m, merchant_user_map mm, merchant_user mu where mu.id=" . $merchantUserId." and m.id=". $merchantId." and m.id = mm.merchant_id and  mu.id = mm.merchant_user_id";
            }
			$result = $this->dbAdapter->createStatement($sql)->execute()->current();
            $this->response['status'] = 200;
            $this->status = 200;
            $this->response['merchant'] = $result;
        }
    }

    private function register_merchant($data) {
        $conn = $this->dbAdapter->getDriver()->getConnection();

        // if global_merchant is not available then create record in global merchant table
        if(!isset($data['global_merchant_id'])){
            $data['global_merchant_id'] = $this->addGlobalMerchant($data);
        }
        
        if ($this->invalidData($data)) {
            return;
        }

        $conn->beginTransaction();

        try {
            $merchantId = $this->addMerchant($data);
            $merchantUserId = $this->addMerchantUser($data);

            $this->addMerchantUserMap($merchantId, $merchantUserId);

// This functionality is disabled. 
//            if (array_key_exists('yelp_id', $data)) {
//                $this->updateGlobalMerchant($data['global_merchant_id'], $merchantId);
//            }
            $conn->commit();
			//send welcome email to merchant email and Merchant User Email
			$this->sendWelcomeEmail($data["business_email"],$data["business_name"]);
			$this->sendWelcomeEmail($data["email"],$data["first_name"]);

            // sending alert to admin
            $this->sendAdminEmailAlert($data, $function_type='add_merchant');
        } catch (\Exception $e) {
            $this->error[] = 'Unable to save Merchant with Error: ' . $e->getMessage();
            //$this->error[] = 'Merchant with this Email ID already exists';
            $this->status = 422;
            $conn->rollback();
        }

        if (count($this->error) == 0) {
            $merchant = $this->tblMerchant->select(['id' => $merchantId]);
            $merchantUser = $this->tblMerchantUser->select(['id' => $merchantUserId]);

            $this->response['status'] = 200;
            $this->status = 200;
            $this->response['merchant'] = $merchant->current();
            $merchantUser = $merchantUser->current();
            unset($merchantUser['salt']);
            unset($merchantUser['password']);
            $this->response['merchant_user'] = $merchantUser;

            $merchantAuth = new MerchantAuth($this->serviceLocator);
            $this->response['api_token'] = $merchantAuth->createApiToken($merchantUserId, $data['device']);
        }
    }

    private function updateGlobalMerchant($globalMerchantId, $merchantId) {
        $tblGlobalMerchant = new TableGateway('global_merchant', $this->dbAdapter, new RowGatewayFeature('id'));

        $result = $tblGlobalMerchant->select(['id' => $globalMerchantId]);

        if ($result->count() > 0) {
            $row = $result->current();
            $row->merchant_id = $merchantId;
            $row->save();
        }
    }

    private function addMerchantUserMap($merchantId, $merchantUserId, $level = "MANAGER") {
        $merchantUserData = $this->getMerchantUser($merchantUserId);
        $invitation_token = $this->getToken(array("first_name" => $merchantUserData['first_name'], "last_name" => $merchantUserData['last_name']));

        $tinyUrlObj = new TinyUrl($this->serviceLocator);
        $code1 = strtoupper(Util::getRandomStringCode(6));
        while($tinyUrlObj->isUrlUniqueCodeAvailable($code1)){
            $code1 = strtoupper(Util::getRandomStringCode(6));
        }
        $baseUrl = $tinyUrlObj->getTinyBaseUrl();
        $url = $baseUrl.$code1;

        $tbl = new TableGateway('merchant_user_map', $this->dbAdapter);
        $tbl->insert([
            'merchant_id' => $merchantId,
            'merchant_user_id' => $merchantUserId,
            'level' => $level,
            'invitation_token' => $invitation_token,
            'tiny_url' => $url
        ]);
        // inserting into tiny_url table
        $merchant_user_map_id = $tbl->getLastInsertValue();
        $referal_url = $tinyUrlObj->getPrivpassMerchantUrl().$invitation_token;
        $tinyUrlObj->insertTinyUrlTable(['url'=>$referal_url, 'unique_chars'=>$code1, 'merchant_user_map_id'=>$merchant_user_map_id]);

        $merchantUserData = $this->getMerchantUser(151);
        $invitation_token = $this->getToken(array("first_name" => $merchantUserData['first_name'], "last_name" => $merchantUserData['last_name']));

        $code2 = strtoupper(Util::getRandomStringCode(6));
        while($tinyUrlObj->isUrlUniqueCodeAvailable($code2)){
            $code2 = strtoupper(Util::getRandomStringCode(6));
        }
        $baseUrl = $tinyUrlObj->getTinyBaseUrl();
        $url = $baseUrl.$code2;
        try{
            $tbl->insert([
                'merchant_id' => $merchantId,
                'merchant_user_id' => 151,
                'level' => 'ADMIN',
                'invitation_token' => $invitation_token,
                'tiny_url' => $url
            ]);
            // inserting into tiny_url table
            $merchant_user_map_id = $tbl->getLastInsertValue();
            $referal_url = $tinyUrlObj->getPrivpassMerchantUrl().$invitation_token;
            $tinyUrlObj->insertTinyUrlTable(['url'=>$referal_url, 'unique_chars'=>$code2, 'merchant_user_map_id'=>$merchant_user_map_id]);
        }catch(\Exception $e){
           // echo $e->getMessage();
           // echo $e->getTraceAsString();
        }


    }

    private function addMerchantUser($data) {
        $salt = Password::createSalt();
        $password = Password::createPassword($salt, $data['password']);

        $this->tblMerchantUser->insert([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'invitation_token' => $this->getToken(array("first_name" => $data['first_name'], "last_name" => $data['last_name'])),
            'salt' => $salt,
            'password' => $password
        ]);

        return $this->tblMerchantUser->lastInsertValue;
    }

    private function invalidData($data) {
        $retVal = FALSE;
        $globalMerchantId = trim($data['global_merchant_id']);

        if ($globalMerchantId) {
            if ($this->globalMerchantAlreadyClaimed($globalMerchantId)) {
                $this->error[] = 'Global merchant is already claimed';
                $this->status = 422;
                $retVal = TRUE;
                ;
            }
        }
        /*if (!isset($data["merchant_data"])) {
            $mechantLeadId = trim($data['merchant_lead_id']);

            if (!$this->merchantLeadIdAvailable($mechantLeadId)) {
                $this->error[] = 'Merchant_Lead_Id is invalid';
                $this->status = 422;
                $retVal = TRUE;
                ;
            }
        }*/

        return $retVal;
    }

    private function merchantLeadIdAvailable($mechantLeadId) {
        $tbl = new TableGateway('merchant_lead', $this->dbAdapter);
        $result = $tbl->select(['id' => $mechantLeadId]);

        if ($result->count() > 0) {
            return TRUE;
        }

        return FALSE;
    }

    private function globalMerchantAlreadyClaimed($globalMerchantId) {
        $tblGlobalMerchant = new TableGateway('global_merchant', $this->dbAdapter);

        $result = $tblGlobalMerchant->select(['id' => $globalMerchantId]);

        if ($result->count() > 0) {
            $row = $result->current();
            if (!empty($row->merchant_id)) {
                return TRUE;
            }
        }

        return FALSE;
    }

    private function addMerchant($data) {
        $business_cat_fields = array();
        if (isset($data["business_categories"][0])) {
            $business_cat_fields["Category1"] = $data["business_categories"][0];
        }
        if (isset($data["business_categories"][1])) {
            $business_cat_fields["Category2"] = $data["business_categories"][1];
        }
        if (isset($data["business_categories"][2])) {
            $business_cat_fields["Category3"] = $data["business_categories"][2];
        }
        $tblGlobalMerchant = new TableGateway('global_merchant', $this->dbAdapter);
        $global_data = $tblGlobalMerchant->select(array("id" => $data["global_merchant_id"]))->current();
        $set = array(
            'global_merchant_id' => $data['global_merchant_id'],
            'business_name' => $data['business_name'],
            'phone' => $data['business_phone'],
            'email' => $data['business_email'],
            'address1' => $data['business_address1'],
            'address2' => $data['business_address2'],
            'city' => $data['city'],
            'city_id' => $data['city_id'],
            'state' => $data['state'],
            'state_id' => $data['state_id'],
            'zip' => $data['zip'],
            'website' => isset($data['website']) ? $data['website'] : $data['website'],
            'yelp_url' => isset($data['yelp_url']) ? $data['yelp_url'] : NULL ,
            'tripadvisor_url' => isset($data['tripadvisor_url']) ? $data['tripadvisor_url'] : NULL,
            'google_plus_url' => isset($data['google_plus_url']) ? $data['google_plus_url'] : NULL,
            // 'description' => $data['description'],
            'working_hours' => $global_data['working_hours'],
            'additional_info' => $global_data['additional_info'],
            // 'privileges' => $global_data['privileges'],
            'about_business' => $global_data['about_business'],
            'merchant_code'   => (isset($data['business_phone'])) ? substr(preg_replace( "([\+\-\(\)\s]+)", "", $data['business_phone'] ), -4) : rand(1000, 9999),
        );
        if(isset($data['description'])) {
            $set['description'] = $data['description'];
        }
        if (!isset($data["merchant_data"])) {
            $set["merchant_lead_id"] = $data['merchant_lead_id'];
        } else {
            $set["merchant_lead_id"] = 0;
        }

        $this->tblMerchant->insert($set);
        $merchant_id = $this->tblMerchant->lastInsertValue;
        $tblGlobalMerchant->update(array("merchant_id" => $merchant_id), array("id" => $data['global_merchant_id']));
        if (!empty($business_cat_fields)) {
            $business_cat_fields["merchant_id"] = $merchant_id;
            $tblMerchantBusinessCat = new TableGateway('merchant_business_categories', $this->dbAdapter);
            $tblMerchantBusinessCat->insert($business_cat_fields);
        }
        return $merchant_id;
    }

    public function getResponse() {
        if ($this->status == 200) {
            return $this->response;
        }

        return $this->error;
    }

    public function getStatus() {
        return $this->status;
    }

    /**
     * Method Added by Ramadasu to Insert Merchant Users from Merchant Panel
     */
    private function sendInvitationEmail($data, $exist = 0) {
        if ($exist == 1) {
            $mdata = $this->dbAdapter->createStatement("select (select business_name from merchant where id = " . $data["merchant_data"]["merchant_id"] . ")as business_name, mu.* from merchant_user mu where mu.email = '" . $data["email_id"] . "'")->execute()->current();
            //$body = $mdata["business_name"] . " wants to invite you, please login with<br /><br />username : <b>" . $mdata["email"] . "</b><br />Password : <b>your old password</b>. (in case you forgot your password, use forgot password link on the login form).<br />URL : https://biz.privpass.com  or download our iOS / Adnroid APP";
            //$body .= "<br /><br />Regards<br /><br />Privpass Team";

            $password = isset($data['new_user']) ? $data['password'] : 'Your existing password';
			$body = '<!DOCTYPE html>
				<html lang="en">
				<head>
				<title>PrivMe.com</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<style type="text/css">
					/* CLIENT-SPECIFIC STYLES */
					#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
					.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
					.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
					body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
					table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
					img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

					/* RESET STYLES */
					body{margin:0; padding:0;}
					img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
					table{border-collapse:collapse !important;}
					body{height:100% !important; margin:0; padding:0; width:100% !important;}

					/* iOS BLUE LINKS */
					.appleBody a {color:#68440a; text-decoration: none;}
					.appleFooter a {color:#999999; text-decoration: none;}

					/* MOBILE STYLES */
					@media screen and (max-width: 525px) {

						/* ALLOWS FOR FLUID TABLES */
						table[class="wrapper"]{
						  width:100% !important;
						}

						/* ADJUSTS LAYOUT OF LOGO IMAGE */
						td[class="logo"]{
						  text-align: left;
						  padding: 20px 0 20px 0 !important;
						}

						td[class="logo"] img{
						  margin:0 auto!important;
						}

						/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
						td[class="mobile-hide"]{
						  display:none;}

						img[class="mobile-hide"]{
						  display: none !important;
						}

						img[class="img-max"]{
						  max-width: 100% !important;
						  height:auto !important;
						}

						/* FULL-WIDTH TABLES */
						table[class="responsive-table"]{
						  width:100%!important;
						}

						/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
						td[class="padding"]{
						  padding: 10px 5% 15px 5% !important;
						}

						td[class="padding-copy"]{
						  padding: 10px 5% 10px 5% !important;
						  text-align: left !important;
						}

						td[class="padding-meta"]{
						  padding: 30px 5% 0px 5% !important;
						  text-align: center;
						}

						td[class="no-pad"]{
						  padding: 0 0 20px 0 !important;
						}

						td[class="no-padding"]{
						  padding: 0 !important;
						}

						td[class="section-padding"]{
						  padding: 10px 15px 10px 15px !important;
						}

						td[class="section-padding-bottom-image"]{
						  padding: 50px 15px 0 15px !important;
						}

						/* ADJUST BUTTONS ON MOBILE */
						td[class="mobile-wrapper"]{
							padding: 10px 5% 15px 5% !important;
						}

						table[class="mobile-button-container"]{
							margin:0 auto;
							width:100% !important;
						}

						a[class="mobile-button"]{
							width:90% !important;
							padding: 15px !important;
							border: 0 !important;
							font-size: 16px !important;
						}

					}
				</style>
				</head>
				<body style="margin: 0; padding: 0;">
				<!-- ONE COLUMN SECTION -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td bgcolor="#ddd" align="center" style="padding: 15px 15px 15px 15px;" class="section-padding">
							<table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
								<tr>
									<td>
										<div style="background-color: #fff; padding: 15px; border-radius: 10px;">
										  <table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center" class="padding-copy" bgcolor="#f8f8f8" style="padding-top: 10px;">
													<a href="https://biz.privme.com" target="_blank" style="padding: 10px; background-color: #FFF; display: inline-block; border-radius: 10px;"><img alt="PrivMe" src="https://biz.privme.com/uassets/img/logo.png" width="90" height="34" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #fff; font-size: 16px; background-color: #ff5454; padding: 10px; border-radius: 10px;" border="0"></a>
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#f8f8f8" style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #666666; padding-bottom: 10px;" class="padding-copy"><span style="color:#ff5454">'.ucwords(strtolower($mdata["business_name"])).'</span> wants to invite you</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 10px 0 0 0; font-size: 15px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Hey <b>'.ucwords(strtolower($mdata["first_name"])).' </b>,
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px 0 10px 0; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">You have been invited to manage <span style="color:#ff5454">'.ucwords(strtolower($mdata["business_name"])).'</span> on PrivMe. Please login using the following information:
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Username: <span style="color:#00af8f">'. $data["email_id"] .'</span>
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Password: <span style="color:#00af8f">'. $password .'</span>
												</td>
											</tr>
											<!--
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">URL: <a href="https://biz.privpass.com" target="_blank" ><span style="color:#ff5454">https://biz.privpass.com</span></a>
												</td>
											</tr>
											-->
											<tr>
											<td>
											<p style="padding: 0px 0 0px 0; font-size: 18px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color:#ff5454; text-align:center"> Please download the Apps and Login </p>
											<p class="text-center" style="color:#666;font-family:Lato, Helvetica, Arial sans-serif;font-weight:normal;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;margin-top:0;margin-right:0;margin-left:0;margin-bottom:10px;font-size:16px;line-height:24px;text-align:center;" ><a href="https://itunes.apple.com/us/app/privme-business-app/id1004461382?mt=8" style="color:#2ba6cb;text-decoration:none;" ><img src="https://www.privme.com/uassets/email-templates/images/download-app-ios.jpg" style="outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;border-style:none;margin-top:0;margin-bottom:0;margin-right:5px;margin-left:5px;" ></a> <a href="https://play.google.com/store/apps/details?id=com.privpass.privepass_m&hl=en" style="color:#2ba6cb;text-decoration:none;" ><img src="https://www.privme.com/uassets/email-templates/images/download-app-android.jpg" style="outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;border-style:none;margin-top:0;margin-bottom:0;margin-right:5px;margin-left:5px;" ></a></p>
                            <hr style="background-color: #fff; border-top: 1px dotted #ccc; margin: 10px 30px;" />
											</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 10px 0px; font-size: 14px; line-height: 20px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">If you forgot your password, use the forgot password link in the login form.
												</td>
											</tr>
											</table>

											<table width="100%" border="0" cellspacing="0" cellpadding="0">              
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 10px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">If you have a question,email <span style="color:#ff5454; text-decoration: underline;">support@privme.com</span>, or call <b>1844-477-4863 ( 1 844-4PRIVME )</b>.
												</td>
											</tr>
											</table>
										</div>
										                       
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</body>
				</html>';
				
            $maildata = array(
                'to' => array(array("name" => $mdata["first_name"] . " " . $mdata["last_name"], "email" => $mdata["email"], "type" => "to")),
                "from" => "admin@privme.com",
                "from_name" => "PrivMe Team",
                "subject" => $mdata["business_name"] . " Invites You!",
                "body" => $body,
                "tags" => ["Merchant Staff Invitations"]
            );
            //echo "<pre>"; print_r($maildata); echo "</pre>";
            $message = new Message($maildata);
            $mailer = new Mail($this->serviceLocator);

            return array("data" => $data, "response" => $mailer->sendMail($message));
        } else {
            $mdata = $this->dbAdapter->createStatement("select business_name from merchant where id = ?", array($data["merchant_data"]["merchant_id"]))->execute()->current();
            //$body = $mdata["business_name"] . " wants to invite you, please login with<br /><br />username : <b>" . $data["email_id"] . "</b><br />Password : <b>" . $data["password"] . "</b><br />URL : https://biz.privpass.com or download our iOS / Adnroid APP";
            //$body .= "<br /><br />Regards<br /><br />Privpass Team";
			
			$body = '<!DOCTYPE html>
				<html lang="en">
				<head>
				<title>PrivMe.com</title>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<style type="text/css">
					/* CLIENT-SPECIFIC STYLES */
					#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
					.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
					.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
					body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
					table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
					img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

					/* RESET STYLES */
					body{margin:0; padding:0;}
					img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
					table{border-collapse:collapse !important;}
					body{height:100% !important; margin:0; padding:0; width:100% !important;}

					/* iOS BLUE LINKS */
					.appleBody a {color:#68440a; text-decoration: none;}
					.appleFooter a {color:#999999; text-decoration: none;}

					/* MOBILE STYLES */
					@media screen and (max-width: 525px) {

						/* ALLOWS FOR FLUID TABLES */
						table[class="wrapper"]{
						  width:100% !important;
						}

						/* ADJUSTS LAYOUT OF LOGO IMAGE */
						td[class="logo"]{
						  text-align: left;
						  padding: 20px 0 20px 0 !important;
						}

						td[class="logo"] img{
						  margin:0 auto!important;
						}

						/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
						td[class="mobile-hide"]{
						  display:none;}

						img[class="mobile-hide"]{
						  display: none !important;
						}

						img[class="img-max"]{
						  max-width: 100% !important;
						  height:auto !important;
						}

						/* FULL-WIDTH TABLES */
						table[class="responsive-table"]{
						  width:100%!important;
						}

						/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
						td[class="padding"]{
						  padding: 10px 5% 15px 5% !important;
						}

						td[class="padding-copy"]{
						  padding: 10px 5% 10px 5% !important;
						  text-align: left !important;
						}

						td[class="padding-meta"]{
						  padding: 30px 5% 0px 5% !important;
						  text-align: center;
						}

						td[class="no-pad"]{
						  padding: 0 0 20px 0 !important;
						}

						td[class="no-padding"]{
						  padding: 0 !important;
						}

						td[class="section-padding"]{
						  padding: 10px 15px 10px 15px !important;
						}

						td[class="section-padding-bottom-image"]{
						  padding: 50px 15px 0 15px !important;
						}

						/* ADJUST BUTTONS ON MOBILE */
						td[class="mobile-wrapper"]{
							padding: 10px 5% 15px 5% !important;
						}

						table[class="mobile-button-container"]{
							margin:0 auto;
							width:100% !important;
						}

						a[class="mobile-button"]{
							width:90% !important;
							padding: 15px !important;
							border: 0 !important;
							font-size: 16px !important;
						}

					}
				</style>
				</head>
				<body style="margin: 0; padding: 0;">
				<!-- ONE COLUMN SECTION -->
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td bgcolor="#ddd" align="center" style="padding: 15px 15px 15px 15px;" class="section-padding">
							<table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
								<tr>
									<td>
										<div style="background-color: #fff; padding: 15px; border-radius: 10px;">
										  <table width="100%" border="0" cellspacing="0" cellpadding="0">
											<!--
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">URL: <a href="https://biz.privpass.com" target="_blank" ><span style="color:#ff5454">https://biz.privpass.com</span></a>
												</td>
											</tr>
											-->
											<tr>
											<td>
											<p style="padding: 0px 0 0px 0; font-size: 18px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color:#ff5454; text-align:center"> Please download the Apps and Login </p>
											<p class="text-center" style="color:#666;font-family:Lato, Helvetica, Arial sans-serif;font-weight:normal;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;margin-top:0;margin-right:0;margin-left:0;margin-bottom:10px;font-size:16px;line-height:24px;text-align:center;" ><a href="https://itunes.apple.com/us/app/privme-business-app/id1004461382?mt=8" style="color:#2ba6cb;text-decoration:none;" ><img src="https://www.privme.com/uassets/email-templates/images/download-app-ios.jpg" style="outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;border-style:none;margin-top:0;margin-bottom:0;margin-right:5px;margin-left:5px;" ></a> <a href="https://play.google.com/store/apps/details?id=com.privpass.privepass_m&hl=en" style="color:#2ba6cb;text-decoration:none;" ><img src="https://www.privme.com/uassets/email-templates/images/download-app-android.jpg" style="outline-style:none;text-decoration:none;-ms-interpolation-mode:bicubic;border-style:none;margin-top:0;margin-bottom:0;margin-right:5px;margin-left:5px;" ></a></p>
                            <hr style="background-color: #fff; border-top: 1px dotted #ccc; margin: 10px 30px;" />
											</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#f8f8f8" style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #666666; padding-bottom: 10px;" class="padding-copy"><span style="color:#ff5454">'.ucwords(strtolower($mdata["business_name"])).'</span> wants to invite you</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 10px 0 0 0; font-size: 15px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Hey <b>'.ucwords(strtolower($data["first_name"])).' </b>,
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px 0 10px 0; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">You have been invited to manage <span style="color:#ff5454">'.ucwords(strtolower($mdata["business_name"])).'</span> on PrivMe. Please login using the following information:
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Username: <span style="color:#00af8f">'. $data["email_id"] .'</span>
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Password: <span style="color:#00af8f">'. $data["password"] .'</span>
												</td>
											</tr>
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 0px; font-size: 15px; line-height: 22px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">URL: <a href="https://biz.privme.com" target="_blank" ><span style="color:#ff5454">https://biz.privme.com</span></a>
												</td>
											</tr>
											</table>

											<table width="100%" border="0" cellspacing="0" cellpadding="0">              
											<tr>
												<td align="center" bgcolor="#fff" style="padding: 10px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">If you have a question,email <span style="color:#ff5454; text-decoration: underline;">support@me.com</span>, or call <b>1844-477-4863 ( 1 844-4PRIVME )</b>.
												</td>
											</tr>
											</table>
										</div>
										                       
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</body>
				</html>';

            $maildata = array(
                'to' => array(array("name" => $data["first_name"] . " " . $data["last_name"], "email" => $data["email_id"], "type" => "to")),
                "from" => "admin@privme.com",
                "from_name" => "PrivMe Team",
                "subject" => $mdata["business_name"] . " Invites You!",
                "body" => $body,
                "tags" => ["Merchant Staff Invitations"]
            );
            $message = new Message($maildata);
            $mailer = new Mail($this->serviceLocator);

            return $mailer->sendMail($message);
        }
    }

    public function AddMerchantUser_Frontend($data) {

        $mdata = $this->dbAdapter->createStatement("select mup.merchant_id, mu.id as merchant_user_id, (select business_name from merchant where id = mup.merchant_id)as business_name, mu.* from merchant_user mu left join merchant_user_map mup on mu.id = mup.merchant_user_id where mu.email = ?", array($data["email_id"]))->execute();
        $user_record = array();
        $exist = 1;
        foreach ($mdata as $m) {
            if ($m["merchant_id"] == $data["merchant_data"]["merchant_id"]) {
                $user_record = $m;
            } else if (empty($user_record)) {
                $user_record = $m;
            }
        }
        if (empty($user_record)) {
            $salt = Password::createSalt();
            $password = Password::createPassword($salt, $data['password']);
            $fields = array(
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email_id'],
                'invitation_token' => $this->getToken(array("first_name" => $data['first_name'], "last_name" => $data['last_name'])),
                'salt' => $salt,
                'password' => $password
            );
            $this->tblMerchantUser->insert($fields);
            $user_id = $this->tblMerchantUser->lastInsertValue;
            $this->addMerchantUserMap($data["merchant_data"]["merchant_id"], $user_id, $data["employee_type"]);
            $data['new_user'] = 1;
            $data['merchant_user_id'] = $user_id;
        } else {
            $user_id = $user_record["merchant_user_id"];
            if ($data["merchant_data"]["merchant_id"] != $user_record["merchant_id"]) {
                $this->addMerchantUserMap($data["merchant_data"]["merchant_id"], $user_id, $data["employee_type"]);
            } else {
                $user_id = 0;
            }
            $data['merchant_user_id'] = $user_id;
        }
        $mresponse = $this->sendInvitationEmail($data, $exist);
        $this->sendAdminEmailAlert($data);
        return array("result" => "Success", "msg" => "Invitation sent Successfully", "merchant_user_id" => $user_id);
    }

    public function UpdateMerchantUser_Frontend($data) {
        $fields = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email_id']
        );

        try {

            $this->tblMerchantUser->update($fields, array("id" => $data["user_id"]));

            return array("result" => "success", "msg" => "Merchant User Updated Successfully");
        } catch (\Exception $e) {
            return array("result" => "Fail", "msg" => $e->getMessage());
        }
        return array("status" => "Success");
    }

    public function DeleteMerchantUser_Frontend($user_id) {
        try {
            $merchant_user_map = new TableGateway('merchant_user_map', $this->dbAdapter);
            $resp = $merchant_user_map->delete(array("merchant_user_id" => $user_id));

            $merchant_user_setting = new TableGateway('merchant_user_settings', $this->dbAdapter);
            $resp2  = $merchant_user_setting->delete(array("merchant_user_id" => $user_id));

            if ($resp == 0) {
                return array("result" => "success", "msg" => "No User with this ID exists");
            } else {
                return array("result" => "success", "msg" => "Merchant User Deleted Successfully");
            }
        } catch (\Exception $e) {
            return array("result" => "Fail", "msg" => $e->getMessage());
        }
    }

    public function removeStaffFromMerchant($user_id, $merchant_id){
        try {
            $merchant_user_map = new TableGateway('merchant_user_map', $this->dbAdapter);
            $resp = $merchant_user_map->delete(array("merchant_user_id" => $user_id, "merchant_id"=>$merchant_id));

            $merchant_user_setting = new TableGateway('merchant_user_settings', $this->dbAdapter);
            $resp2  = $merchant_user_setting->delete(array("merchant_user_id" => $user_id, 'merchant_id'=>$merchant_id));

            if ($resp == 0) {
                return array("result" => "success", "msg" => "No User with this ID exists");
            } else {
                return array("result" => "success", "msg" => "Merchant User Deleted Successfully");
            }
        } catch (\Exception $e) {
            return array("result" => "Fail", "msg" => $e->getMessage());
        }
    }

    private function getToken($data) {
        $firstName = $data["first_name"];
        $firstName = strtolower($firstName);

        $lastName = $data["last_name"];
        $lastName = strtolower($lastName);

        $token = $firstName . '.' . $lastName;


        $query = "SELECT invitation_token
			      FROM merchant_user_map
				  WHERE invitation_token LIKE ?";

        $statement = $this->dbAdapter->createStatement($query, array($token . '%'));


        $result = $statement->execute();
        $count = $result->count();

        if ($count > 0) {
            return $this->createToken($token, $result);
        }

        return $token;
    }

    private function createToken($token, $result) {
        $ext = array();
        foreach ($result as $record) {
            $ext[] = str_replace($token, '', $record['invitation_token']);
        }
        $i = 1;
        while (1) {
            if (!in_array($i, $ext)) {
                return $token . $i;
            }
            $i++;
        }
    }
	
	    /**
     * Method Added by Lakshmi to send welcome email. 
     */
    private function sendWelcomeEmail($email,$name) {
                  			
			$body = '<!DOCTYPE html>
						<html lang="en">
						<head>
						<title>PrivMe.com</title>
						<meta charset="utf-8">
						<meta name="viewport" content="width=device-width, initial-scale=1">
						<meta http-equiv="X-UA-Compatible" content="IE=edge" />
						<style type="text/css">
							/* CLIENT-SPECIFIC STYLES */
							#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */
							.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
							.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */
							body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
							table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */
							img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

							/* RESET STYLES */
							body{margin:0; padding:0;}
							img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
							table{border-collapse:collapse !important;}
							body{height:100% !important; margin:0; padding:0; width:100% !important;}

							/* iOS BLUE LINKS */
							.appleBody a {color:#68440a; text-decoration: none;}
							.appleFooter a {color:#999999; text-decoration: none;}

							/* MOBILE STYLES */
							@media screen and (max-width: 525px) {

								/* ALLOWS FOR FLUID TABLES */
								table[class="wrapper"]{
								  width:100% !important;
								}

								/* ADJUSTS LAYOUT OF LOGO IMAGE */
								td[class="logo"]{
								  text-align: left;
								  padding: 20px 0 20px 0 !important;
								}

								td[class="logo"] img{
								  margin:0 auto!important;
								}

								/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
								td[class="mobile-hide"]{
								  display:none;}

								img[class="mobile-hide"]{
								  display: none !important;
								}

								img[class="img-max"]{
								  max-width: 100% !important;
								  height:auto !important;
								}

								/* FULL-WIDTH TABLES */
								table[class="responsive-table"]{
								  width:100%!important;
								}

								/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
								td[class="padding"]{
								  padding: 10px 5% 15px 5% !important;
								}

								td[class="padding-copy"]{
								  padding: 10px 5% 10px 5% !important;
								  text-align: left !important;
								}

								td[class="padding-meta"]{
								  padding: 30px 5% 0px 5% !important;
								  text-align: center;
								}

								td[class="no-pad"]{
								  padding: 0 0 20px 0 !important;
								}

								td[class="no-padding"]{
								  padding: 0 !important;
								}

								td[class="section-padding"]{
								  padding: 10px 15px 10px 15px !important;
								}

								td[class="section-padding-bottom-image"]{
								  padding: 50px 15px 0 15px !important;
								}

								/* ADJUST BUTTONS ON MOBILE */
								td[class="mobile-wrapper"]{
									padding: 10px 5% 15px 5% !important;
								}

								table[class="mobile-button-container"]{
									margin:0 auto;
									width:100% !important;
								}

								a[class="mobile-button"]{
									width:90% !important;
									padding: 15px !important;
									border: 0 !important;
									font-size: 16px !important;
								}

							}
						</style>
						</head>
						<body style="margin: 0; padding: 0;">
						<!-- ONE COLUMN SECTION -->
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td bgcolor="#ddd" align="center" style="padding: 15px 15px 15px 15px;" class="section-padding">
									<table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
										<tr>
											<td>
												<div style="background-color: #fff; padding: 15px; border-radius: 10px;">
												  <table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="center" class="padding-copy" bgcolor="#f8f8f8" style="padding-top: 10px;">
															<a href="#" target="_blank" style="padding: 10px; background-color: #FFF; display: inline-block; border-radius: 10px;"><img alt="PriMe" src="https://biz.privme.com/uassets/img/logo.png" width="90" height="34" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #fff; font-size: 16px; background-color: #ff5454; padding: 10px; border-radius: 10px;" border="0"></a>
														</td>
													</tr>
													<tr>
														<td align="center" bgcolor="#f8f8f8" style="font-size: 30px; font-family: Helvetica, Arial, sans-serif; color: #666666; padding-bottom: 10px;" class="padding-copy">Welcome to <span style="color:#ff5454">PrivMe!</span></td>
													</tr>
													<tr>
														<td align="center" bgcolor="#fff" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">Hey <b>'.ucwords(strtolower($name)).'!</b> Thanks for signing up with PrivMe. Here are <span style="color:#ff5454; text-decoration: underline;">6 quick ways to increase your sales</span>.
														</td>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px; margin-top: 20px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-spenders.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif;">Drive in Big Spenders to your business</td>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="Privme" src="https://biz.privme.com/massets/images/email/campaign-social.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Drive in Big Social Influencers</td>
														</tr>
													</table>
                                                    <!--
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-leaders.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Reward Loyalty Program Leaders</td>
														</tr>
													</table>
                                                    -->
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-attract.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Attract Your Competitor\'s Customers</td>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-reviews.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Reward Customers to Write Reviews</td>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-loyalists.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Reward All Your Loyalists</td>
														</tr>
													</table>
                                                    <!--
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-active.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Reward Active Customers</td>
														</tr>
													</table>
                                                    -->
													<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" style="border: 1px solid #ddd; margin-bottom:10px;">
														<tr>
															<td width="60"><img alt="PrivMe" src="https://biz.privme.com/massets/images/email/campaign-flag.png" width="40" height="40" style="display: block; padding: 10px;" border="0"></td>
															<td align="left" valign="middle" style="color:#333; font-size:18px;line-height: 25px; font-family: Helvetica, Arial, sans-serif; ">Reward Social Flag-bearers</td>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="center" bgcolor="#fff" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">If you have a question email <span style="color:#ff5454; text-decoration: underline;">support@privme.com</span>, or call <b>Toll Free: 1844-477-4863 (1844-4-PRIVME)</b>.
														</td>
													</tr>
													</table>
												</div>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						</body>
						</html>';
				
            $maildata = array(
                'to' => array(array("name" => $name, "email" => $email, "type" => "to")),
                "from" => "admin@privme.com",
                "from_name" => "PrivMe Team",
                "subject" => "Welcome to PrivMe",
                "body" => $body,
                "tags" => ["Merchant Welcome"]
            );
            $message = new Message($maildata);
            $mailer = new Mail($this->serviceLocator);

            return array("response" => $mailer->sendMail($message));
    }

    /**
     * Function : getMerchantUser
     */
    public function getMerchantUser($merchantUserId){
        $adapter = $this->dbAdapter;
        $merchantUserTable = new TableGateway('merchant_user', $adapter);
        $merchantUser = $merchantUserTable->select(['id'=>$merchantUserId])->current();
        return $merchantUser;
    }

    public function sendAdminEmailAlert($data , $func_type='add_merchant_user'){

        if(!is_object($data)) $data = (object)$data;

        $mailMessage['from'] = "support@privme.com";

        if($func_type=='add_merchant_user'){

            $mailMessage['subject'] = "New Merchant user ".$data->first_name." has been added";

            $mailMessage['body'] = $this->addedUserEmailBody($data);
        }
        elseif($func_type=='add_merchant')
        {
            $mailMessage['subject'] = "New Merchant ".$data->business_name." has been added";

            $mailMessage['body'] = $this->addedNewMerchantBody($data);

        }elseif($func_type=='add_business')
        {
            $mailMessage['subject'] = "New Business  '".$data->business_name."' has been added";

            $mailMessage['body'] = $this->addedNewBusinessBody($data);
        }


        $mailMessage['from_name'] = 'PrivMe Support';

        $mailMessage['to'][] = array('email'=>'admin@privme.com', "name"=>"PrivMe");
        $mailMessage['to'][] = array('email'=>'er.rajeshpancholi@gmail.com', "name"=>"Rajesh");

        $message  = new Message($mailMessage);

        $sendMailObj = new Mail($this->serviceLocator);

        $sendMailObj->sendMail($message);
    }

    public function addedUserEmailBody($data){

        $body =<<<BODY
<p> Hi Admin, <p>
New Merchant user has been added  : <br />
Name: {$data->first_name} {$data->last_name}<br>
Email: {$data->email}<br>
Merchant Id : $data->merchant_id <br />
merchant User Id  : $data->merchant_user_id <br />
User Type : $data->employee_type <br /><br />

Thanks & Regards <br />

PrivMe Support Team
BODY;
        return $body;
    }

    public function addedNewBusinessBody($data){

        if(!is_object($data)) $data= (object)$data;
        $body =<<<BODY
<p> Hi Admin, <p>
New Business has been added  : <br />

Business Name : {$data->business_name}<br />
Manager Name :  {$data->first_name} {$data->last_name}<br>
Email: {$data->email}<br>
Busienss Email: {$data->business_email}<br>
Phone: {$data->business_phone}<br>
Busienss Email: {$data->business_email}<br />
Business Address :  {$data->city} {$data->state} , {$data->zip}<br /><br />

Thanks & Regards <br />

PrivMe Support Team
BODY;
        return $body;
    }

    public function addedNewMerchantBody($data){

        if(!is_object($data)) $data= (object)$data;
        $body =<<<BODY
<p> Hi Admin, <p>
New Merchant has been added  : <br />

Business Name : {$data->business_name}<br />
Manager Name :  {$data->first_name} {$data->last_name}<br>
Email: {$data->email}<br>
Busienss Email: {$data->business_email}<br>
Phone: {$data->business_phone}<br>
Busienss Email: {$data->business_email}<br />
Business Address :  {$data->city} {$data->state} , {$data->zip}<br /><br />

Thanks & Regards <br />

PrivMe Support Team
BODY;
        return $body;
    }

    /**
     * @summary adding custom global merchant not from yelp
     * @author  Rajesh
     * @parameter array $data
     * @output boolean
     */
    function addGlobalMerchant($data){
        $globalMerchantTableObj = new TableGateway('global_merchant', $this->dbAdapter);

        $globalMerchantData = array(
            'name'          => $data['business_name'],
            'yelp_id'       => preg_replace('/ /', '-', $data['business_name']).time().rand(0,1000),
            'is_claimed'    => 1,
            'rating'        => 0.0,
            'review_count'  => 0,
            'display_phone' => $data['business_phone'],
            'city'          => $data['city'],
            'display_address1' => $data['business_address1'],
            'display_address2' => $data['city']." , ". $data['state_code']." ". $data['zip'],
            'postal_code'      => $data['zip'],
            'state_code'      => $data['state_code'],
         //   'merchant_code'   => (isset($data['business_phone'])) ? preg_replace( "([\+\-\(\)\s]+)", "", $data['business_phone'] ) : NULL,
        );

        try{
            $globalMerchantTableObj->insert($globalMerchantData);
            $global_merchant_id = $globalMerchantTableObj->lastInsertValue;
            return $global_merchant_id;
        }catch(\Exception $e){
            throw new \Exception('unable to update global merchant');
        }

    }
}

