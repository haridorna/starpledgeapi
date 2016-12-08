<?php
namespace Customer1\V1\Rpc\GetInstagramData;

use Customer1\V1\Model\InstagramConnect;
use Intuit\V1\Rpc\AddSiteAccount\AddSiteAccountController;
use MetzWeb\Instagram\Instagram;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use Application\Auth\User;

class GetInstagramDataController extends AbstractActionController
{
    public function getInstagramDataAction()
    {
        $reqObj = $this->getRequest();

        if($reqObj->isPost()){

            $data = json_decode($reqObj->getContent());
            $user = User::getInfo();

            if (!$user) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }


            if ($user['customer_id'] != $data->customer_id) {
                return new ApiProblemResponse(new ApiProblem(401, 'Unauthorized'));
            }
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $hasSocialMediaTable = new TableGateway("has_social_media",$adapter );


            try{
                $config = $this->getServiceLocator()->get('config');
                $instagramObj = new Instagram($config['api']['instagram']);
                $instagramObj->setAccessToken($data->access_token);
                $user = $instagramObj->getUser();
                $isInstgramDataAvailableForCustomer = $hasSocialMediaTable->select([
                    "media_id"=>4,
                    "customer_id"=>$data->customer_id
                ]);

                // var_dump($instagramObj->getUserMedia());
                if($isInstgramDataAvailableForCustomer->count() == 0){
                    $userMediaData = $instagramObj->getUserMedia();
                    if($user->meta->code == 200) {
                        $instagramData['media_id'] = 4;
                        $instagramData['social_media_id'] = $user->data->id;
                        $instagramData['social_media_name'] = $user->data->username;
                        $instagramData['name'] = $user->data->full_name;
                        $instagramData['customer_id'] = $data->customer_id;
                        $instagramData['access_token'] = $data->access_token;
                        $instagramData['num_followers'] = $user->data->counts->followed_by;
                        $instagramData['num_following'] = $user->data->counts->follows;
                        $instagramData['num_post'] = $user->data->counts->media;
                        $instagramData['pic_big_url'] = $user->data->profile_picture;
                        $instagramData['pic_url'] = $user->data->profile_picture;
                        $instagramData['pic_square_url'] = $user->data->profile_picture;

                        $likes = 0;
                        $comments = 0;
                        if (count($userMediaData->data) > 0) {
                            foreach ($userMediaData->data as $media) {
                                $likes += $media->likes->count;
                                $comments += $media->comments->count;
                            }
                            $instagramData['num_likes'] = $likes;
                            $instagramData['num_comments']  = $comments;
                        }

                        $hasSocialMediaTable->insert($instagramData);

                        $tableObj = new TableGateway('customer', $adapter);

                        $tableObj->update(array("instagram_id"=>$user->data->id), array("id"=>$data->customer_id));

                        $addSiteAccountObj = new AddSiteAccountController();
                        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
                        $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $data->customer_id);
                        unset($unlocked['VIP Access']);
                        unset($unlocked['rewards']);
                        $unlocked['score'] = '50';
                        return array("status" => 'success', "message" => "Instagram information inserted successfully.", "unlocked"=>$unlocked);

                    }
                }else{
                    $userMediaData = $instagramObj->getUserMedia();
                    if($user->meta->code == 200) {
                        $instagramData['access_token'] = $data->access_token;
                        $instagramData['num_followers'] = $user->data->counts->followed_by;
                        $instagramData['num_following'] = $user->data->counts->follows;
                        $instagramData['num_post'] = $user->data->counts->media;
                        $instagramData['pic_big_url'] = $user->data->profile_picture;
                        $instagramData['pic_url'] = $user->data->profile_picture;
                        $instagramData['pic_square_url'] = $user->data->profile_picture;
                        $likes = 0;
                        $comments = 0;
                        if (count($userMediaData->data) > 0) {
                            foreach ($userMediaData->data as $media) {
                                $likes += $media->likes->count;
                                $comments += $media->comments->count;
                            }
                            $instagramData['num_likes'] = $likes;
                            $instagramData['num_comments']  = $comments;
                        }

                        $addSiteAccountObj = new AddSiteAccountController();
                        $adapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
                        $unlocked = $addSiteAccountObj->customerUnlockData($adapter, $data->customer_id);
                        unset($unlocked['VIP Access']);
                        unset($unlocked['rewards']);

                        $hasSocialMediaTable->update($instagramData, array("id"=>$isInstgramDataAvailableForCustomer->current()['id']));
                        return array("status"=>"message","message"=>"Instagram account details updated successfully." , "unlocked"=>$unlocked);
                    }

                }
            }catch (\Exception $e){
                return new ApiProblemResponse(new ApiProblem(405, $e->getMessage()));
            }

           // return $instagramData;
        }

    }
}
