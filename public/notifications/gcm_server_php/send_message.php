<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_REQUEST["regId"]) && isset($_REQUEST["message"])) {
if(!is_array($_REQUEST['regId'])){$deviceTokenArray = array($_REQUEST['regId']);}
else{$deviceTokenArray=$_REQUEST['regId'];}

    //$regId = $_GET["regId"];
    $message = $_REQUEST["message"];
    $heading=$_REQUEST["title"];
    ini_set("display_errors", "1");
    include_once './GCM.php';
    
    $gcm = new GCM();
    $registatoin_ids = $deviceTokenArray;
    $message = array("price" => $message,"title"=>$heading);

    //adding extra parameters if available in request
    if(isset($_POST['extra_parameters']) && count($_POST['extra_parameters']) > 0 ){
        foreach($_POST['extra_parameters'] as $key=>$value){
            $message[$key] = $value;
        }
    }
    
    $result = $gcm->send_notification($registatoin_ids, $message);

    echo $result;
}
?>
