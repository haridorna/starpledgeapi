<?php
namespace Twitter\V1\Rpc\Connect;

use Twitter\V1\Model\TwitterConnect;
use Zend\Mvc\Controller\AbstractActionController;


class ConnectController extends AbstractActionController
{
    public function connectAction()
    {
        $data               = $this->getRequest()->getContent();
        $data = json_decode($data);

        $tConnect = new TwitterConnect($this->getServiceLocator());
        return $tConnect->fetchData($data);
    }
}
