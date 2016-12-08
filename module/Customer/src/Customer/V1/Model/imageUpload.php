<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 7/21/2015
 * Time: 4:49 PM
 */


namespace Customer\V1\Model;

use Common\Tools\Util;
use Common\V1\Model\S3Upload;
use Aws\CloudFront\Exception\Exception;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;


class imageUpload
{
    private $serviceLocator;
    public  $max_upload_size = 2097152 ; //199229.4; //   ;//2097152; // 2097152;

    function __construct($serviceLocator){

        $this->serviceLocator = $serviceLocator;
    }

    function getBytesFromHexString($hexdata)
    {
        for($count = 0; $count < strlen($hexdata); $count+=2)
            $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

        return implode($bytes);
    }

    function getImageMimeType($imagedata)
    {
        $imagemimetypes = array(
            "jpeg"  => "FFD8",
            "png"   => "89504E470D0A1A0A",
            "gif"   => "474946",
            "bmp"   => "424D",
            "tiff"  => "4949"
        );

        foreach ($imagemimetypes as $mime => $hexbytes)
        {
            $bytes = $this->getBytesFromHexString($hexbytes);
            if (substr($imagedata, 0, strlen($bytes)) == $bytes)
                return $mime;
        }

        return NULL;
    }

    function getFileSize($image_text){
        return (int) (strlen(rtrim($image_text, '=')) * 3 / 4);
    }

    function fileUpload($image_text, $file_to_upload="uploads", $bucketName){
            if(trim($image_text)){
                $decode_image = base64_decode($image_text);
                $ext = $this->getImageMimeType($decode_image);
                $size = $this->getFileSize($image_text) ;
                if(!in_array( $ext  , $this->validImages() )){
                    //  return  $this->getImageMimeType($decode_image);exit;
                    throw new \Exception("Image type is not correct. Please upload jpg , jpeg , png image type.");
                   // return new ApiProblemResponse(new ApiProblem(500,"Image type is not correct. Please upload jpg , jpeg , png image type." ));
                }
                if($size > $this->max_upload_size){
                     throw new \Exception("Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB.");
                    // return new ApiProblemResponse(new ApiProblem(500,"Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB." ));
                }
                //  exit;
                $image_decode = base64_decode($image_text);
                $uniqe_name = time().rand(10,1000);
                $root_url = $_SERVER['DOCUMENT_ROOT']."/".$file_to_upload."/";


               if(!file_exists($root_url)){
                    mkdir($root_url, 0777);
                }

                $image_tmp_url = $root_url.$uniqe_name.".".$ext;

                $image = file_put_contents($root_url.$uniqe_name.".".$ext, $image_decode);

                $s3Upload = new S3Upload($this->serviceLocator);
                $result = $s3Upload->saveFromFile($root_url.$uniqe_name, $ext, $bucketName);
                unlink($root_url.$uniqe_name.".".$ext);
                return $result['ObjectURL'];
                //return array("image_url" => $result['ObjectURL'], "version_id"=>$result['VersionId'] );

            }else{
                throw new \Exception("file text is empty");
               // return new ApiProblemResponse(new ApiProblem(500,"file text is empty" ));
            }
    }

    function profileImageUpload($image_text, $file_to_upload="uploads", $bucketName){

        if(trim($image_text)){
            $decode_image = base64_decode($image_text);
            $ext = $this->getImageMimeType($decode_image);
            $size = $this->getFileSize($image_text) ;
            if(!in_array( $ext  , $this->validImages() )){
                //  return  $this->getImageMimeType($decode_image);exit;
                throw new \Exception("Image type is not correct. Please upload jpg , jpeg , png image type.");
                // return new ApiProblemResponse(new ApiProblem(500,"Image type is not correct. Please upload jpg , jpeg , png image type." ));
            }
            if($size > $this->max_upload_size){
                throw new \Exception("Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB.");
                // return new ApiProblemResponse(new ApiProblem(500,"Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB." ));
            }

            $image_decode = base64_decode($image_text);
            $uniqe_name = time().rand(10,1000);
            $root_url = $_SERVER['DOCUMENT_ROOT']."/".$file_to_upload."/";

            $image = Util::base64ImageToUpload($root_url, $uniqe_name , $ext , $image_decode);

            $image_tmp_url = $root_url.$uniqe_name.".".$ext;

            list($width, $height) = getimagesize($root_url.$uniqe_name.".".$ext);

            $crop_image_name = $uniqe_name."_200X200_".time();


            // need to create the image name so we can use it for uploading to s3
             Util::imageCrop(200, 200, $width, $height, $root_url.$uniqe_name.".".$ext , $ext,$root_url,  $crop_image_name,  $image_tmp_url);
            // uploading image to s3
            $s3Upload = new S3Upload($this->serviceLocator);
            $result = $s3Upload->saveFromFile($root_url.$crop_image_name, $ext, $bucketName);
            unlink($root_url.$uniqe_name.".".$ext);
            unlink($root_url.$crop_image_name.".".$ext);
            return $result['ObjectURL'];
            //return array("image_url" => $result['ObjectURL'], "version_id"=>$result['VersionId'] );

        }else{
            throw new \Exception("file text is empty");
            // return new ApiProblemResponse(new ApiProblem(500,"file text is empty" ));
        }
    }

    function customerMerchantImageUpload($image_text, $file_to_upload="uploads", $bucketName){
        if(trim($image_text)){
            $decode_image = base64_decode($image_text);
            $ext = strtolower($this->getImageMimeType($decode_image));
            $size = $this->getFileSize($image_text) ;
            if(!in_array( $ext  , $this->validImages() )){
                //  return  $this->getImageMimeType($decode_image);exit;
                throw new \Exception("Image type is not correct. Please upload jpg , jpeg , png image type.");
                // return new ApiProblemResponse(new ApiProblem(500,"Image type is not correct. Please upload jpg , jpeg , png image type." ));
            }
            if($size > $this->max_upload_size){
                throw new \Exception("Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB.");
                // return new ApiProblemResponse(new ApiProblem(500,"Maximum upload size is ". self::fileSizeBytesToMbConverter( $this->max_upload_size )." MB." ));
            }

            $image_decode = base64_decode($image_text);
            $uniqe_name = time().rand(10,1000);
            $root_url = $_SERVER['DOCUMENT_ROOT']."/".$file_to_upload."/";

            $image = Util::base64ImageToUpload($root_url, $uniqe_name , $ext , $image_decode);

            $image_tmp_url = $root_url.$uniqe_name.".".$ext;

            $thumb_image        = $uniqe_name."_100X100_".time();
            $big_image          = $uniqe_name."_800X800_".time();

            $image_info = array( 'uploaded_image_name'=>$uniqe_name.".".$ext );
            $images['image_orginal'] = $this->imageCropAndUpload($image_info, $root_url, FALSE ,NULL ,$ext, $bucketName , $image_tmp_url);

            $image_info = array('width'=>800, 'height'=>800, 'uploaded_image_name'=>$uniqe_name.".".$ext );
            $images['image_big_url'] = $this->imageCropAndUpload($image_info, $root_url, TRUE ,$big_image,$ext, $bucketName, $image_tmp_url );

            $image_info = array('width'=>100, 'height'=>100, 'uploaded_image_name'=>$uniqe_name.".".$ext );
            $images['image_url'] = $this->imageCropAndUpload($image_info, $root_url, TRUE ,$thumb_image,$ext, $bucketName, $image_tmp_url );

            unlink($root_url.$uniqe_name.".".$ext);

            return $images;
            // return array("image_url" => $result['ObjectURL'], "version_id"=>$result['VersionId'] );

        }else{
            throw new \Exception("file text is empty");
            // return new ApiProblemResponse(new ApiProblem(500,"file text is empty" ));
        }
    }

    static function fileSizeBytesToMbConverter($size){
        return ($size)/(1024*1024);
    }

    function validImages(){
        return array('gif', 'jpeg', 'jpg', 'png');
    }

    function imageCropAndUpload($image_info, $image_path, $image_crop_flag=true,  $image_uniqe_name=NULL, $ext ,$bucketName, $image_tmp_url ){
        try{
            if($image_crop_flag){
                list($width, $height) = getimagesize($image_path.$image_info['uploaded_image_name']);
                Util::imageCrop($image_info['width'], $image_info['height'], $width, $height, $image_path.$image_info['uploaded_image_name'] , $ext, $image_path ,  $image_uniqe_name, $image_tmp_url );
                $s3Upload = new S3Upload($this->serviceLocator);
                $result = $s3Upload->saveFromFile($image_path.$image_uniqe_name, $ext, $bucketName);
                unlink($image_path.$image_uniqe_name.'.'.$ext);
                return $result['ObjectURL'];
            }else{
                $s3Upload = new S3Upload($this->serviceLocator);
                $result = $s3Upload->saveFromFile(str_replace(".".$ext, '', $image_path.$image_info['uploaded_image_name']), $ext, $bucketName);
                // unlink($image_path.$image_info['uploaded_image_name']);
                return $result['ObjectURL'];
            }
        }catch(\Exception $e){
           return '';
        }
    }

    function uploadeFacebookImage2S3($image_link){
        $url = $image_link;

        // image info
        $image_info = getimagesize($image_link);
        if($image_info){
            $randomString = time().rand(1, 99999999);

            $image_ext = '.jpg';
            if($image_info['mime'] == 'image/jpeg'){
                $image_ext = '.jpeg';
            }elseif($image_info['mime'] == 'image/jpg'){
                $image_ext = ".jpg";
            }elseif($image_info['mime'] == 'image/gif'){
                $image_ext = ".gif";
            }elseif($image_info['mime'] == 'image/png'){
                $image_ext = ".png";
            }elseif($image_info['mime'] = 'image/pjpeg'){
                $image_ext = '.jpeg';
            }

            $image_name = APPLICATION_PATH."/public/uploads/".$randomString.$image_ext;

            file_put_contents($image_name, file_get_contents($url));

            $s3Upload = new S3Upload($this->serviceLocator);

            $result = $s3Upload->saveFromFile(APPLICATION_PATH."/public/uploads/".$randomString, trim($image_ext,"."), 'privpass.profile.image');

          //  $image_url = $this->fileUpload($randomString.$image_ext, APPLICATION_PATH."/uploads/", 'privpass.profile.image');

            unlink($image_name);

            return $result['ObjectURL'];

        }

        return false;

    }
}