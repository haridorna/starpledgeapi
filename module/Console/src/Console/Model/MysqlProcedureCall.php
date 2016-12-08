<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 7/4/2016
 * Time: 10:02 PM
 */

namespace Console\Model;

class MysqlProcedureCall {

    private $servicelocator;

    public function __construct($serviceLocator)
    {
        $this->servicelocator = $serviceLocator;
    }
    public function AddGlobalMerchantFulltext(){
        $adapter = $this->servicelocator->get('Zend\Db\Adapter\Adapter');

        try{
            $stment = $adapter->createStatement();
            $stment->prepare('CALL proc_add_global_merchant_fulltext()');
            $stment->execute();

            return " Procedure proc_add_global_merchant_fulltex done \n";
        }catch(\Exception $e){
            echo "unable to run the proc_add_global_merchant_fulltext procedure. Error: ".$e->getMessage();
        }

    }
}
