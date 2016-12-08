<?php
namespace Merchant\V1\Rpc\SaveMerchatGalleryMedia;

use Zend\Mvc\Controller\AbstractActionController;
use Merchant\V1\Model\AddCampaign;

class SaveMerchatGalleryMediaController extends AbstractActionController
{
    public function saveMerchatGalleryMediaAction()
    {
        $data = json_decode($this->getRequest()->getContent(), true);
        $media = new AddCampaign($this->getServiceLocator());
        return $media->SaveFileToS3($data);
    }
}
