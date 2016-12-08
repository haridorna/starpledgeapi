<?php
/**
 * Created by PhpStorm.
 * User: hari
 * Date: 4/25/14
 * Time: 4:34 PM
 */

namespace Common\Tools;

class Util
{

    public static function getValue($obj, $key, $default = FALSE)
    {
        if (!$obj) {
            return $default;
        }

        if (is_object($obj)) {
            if (isset($obj->$key)) {
                return $obj->$key;
            }
        } else if (is_array($obj)) {
            if (array_key_exists($key, $obj)) {
                return $obj[$key];
            }
        }

        return $default;
    }

    public static function timeElapsedString($dateString) {
        date_default_timezone_set('UTC');

        $ptime = strtotime($dateString);
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 seconds ago';
        }

        $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    public static function convertNumberToAbbr($value, $flag=1){

        // if $value is not 0
        if($value){
            // replacing , to '' to change into complete integer like (1,000 to 1000)
            $value = str_replace(",","", $value);
            if($flag==1 && strlen($value)>4){
                $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

                foreach($abbreviations as $exponent => $abbreviation)
                {
                    if($value >= pow(10, $exponent))
                    {
                        return round(floatval($value / pow(10, $exponent)),1).$abbreviation;
                    }

                }
            }else{
                return $value;
            }

        }else{
            return $value;
        }


    }

    static public function clearTextSpaces($text){
       // return  trim( $text, "\0\t\x0B\r\n");
        $text = preg_replace("/\x20+/", " ", $text);
        return preg_replace("/\n+/", "\n", $text);
    }

    static public function tinyUrl($url){
        $curl = curl_init();
        $post_data = array('format' => 'json',
            'apikey' => '92E62EBF3007D7978898',
            'provider' => 'p_tl',
            'url' => $url );
        $api_url = 'http://tiny-url.info/api/v1/create';
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        return $result["shorturl"];
    }

    /**
     * @param $string_len_required
     * @param string $is_special_char_required
     * @return string
     */
    static function getRandomStringCode($string_len_required, $is_special_char_required= false ){
        $string = "abcdefghi123456789jklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXWZ";
        if($is_special_char_required){
            $string .= "!@$&";
        }
        return substr(str_shuffle($string), 0, $string_len_required);
    }

    static function base64ImageToUpload($root_url,$uniqe_name, $ext,  $image_decode ){
        if(!file_exists($root_url)){
            mkdir($root_url, 0777);
        }
        try{
            $image = file_put_contents($root_url.$uniqe_name.".".$ext, $image_decode);
            return $image;
        }catch (\Exception $e){
            throw new \Exception("Unable to upload the image");
        }

    }

    /**
     * crop an image using with different ratio
     * @param $req_width -- needed width for output images
     * @param $req_height -- need height for output images after crop
     * @param $image_width -- given images width
     * @param $image_height -- given image height
     * @param $src -- complete path of the image
     * @param $image_ext -- image type
     * @param $folder -- folder in which you want to upload the pics in server
     * @param $image_name -- unique image name without extensions which we want to create
     * @return string
     */

    static public function imageCrop($req_width, $req_height, $image_width, $image_height, $src, $image_ext,  $folder,  $image_name , $image_tmp_url){

        $image_ext = strtolower($image_ext);

       /* if ($image_ext == "jpg") {
            $src1 = imagecreatefromjpeg($src);
        } else if ($image_ext == "png") {
            $src1 = imagecreatefrompng($src);
        } else if ($image_ext == "gif") {
            $src1 = imagecreatefromgif($src);
        }elseif($image_ext == "jpeg"){
            $src1 = imagecreatefromjpeg($src);
        }*/

        // checking image with mime type
        $imageinfo = getimagesize($image_tmp_url);

        $image_type = strtolower($imageinfo['mime']);

        if ($image_type == "image/jpg" || $image_type == "image/jpeg" || $image_type == "image/pjpeg" ) {

            $src1 = imagecreatefromjpeg($src);

        } else if ($image_type == "image/png") {

            $src1 = imagecreatefrompng($src);

        } else if ($image_type == "image/gif") {

            $src1 = imagecreatefromgif($src);

        }

        $original_aspect = $image_width / $image_height;
        $thumb_aspect = $req_width / $req_height;

        if ( $original_aspect >= $thumb_aspect ) {
            $new_height = $req_height;
            $new_width = $image_width / ($image_height / $req_height);
        } else {
            $new_width = $req_width;
            $new_height = $image_height / ($image_width / $req_width);
        }

        $tmp = imagecreatetruecolor( $req_width, $req_height );
        // Resize and crop
        imagecopyresampled($tmp,
            $src1,
            0 - ($new_width - $req_width) / 2, // Center the image horizontally
            0 - ($new_height - $req_height) / 2, // Center the image vertically
            0, 0,
            $new_width, $new_height,
            $image_width, $image_height);

        $write_image = $folder.$image_name.'.'.$image_ext;
        switch($image_ext){
            case "gif":
                imagegif($tmp,$write_image);
                break;
            case "jpg":
                imagejpeg($tmp,$write_image,100);
                break;
            case "jpeg":
                imagejpeg($tmp,$write_image,100);
                break;
            case "png":
                imagepng($tmp,$write_image);
                break;
        }
        return $write_image;
    }

    public function checkEmailFormat($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            list($userName, $mailDomain) = explode("@", $email);
            if (!checkdnsrr($mailDomain, "MX"))
            {
                return false;
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * Sorting array of associative arrays - multiple row sorting using a closure.
     * See also: http://the-art-of-web.com/php/sortarray/
     *
     * @param array $data input-array
     * @param string|array $fields array-keys
     * @license Public Domain
     * @return array
     */
    static function sortArray( $data, $field ) {
        $field = (array) $field;
        uasort( $data, function($a, $b) use($field) {
            $retval = 0;
            foreach( $field as $fieldname ) {
                if( $retval == 0 ) $retval = strnatcmp( $a[$fieldname], $b[$fieldname] );
            }
            return $retval;
        } );
        return $data;
    }

    static function form_safe_json($json) {
        $json = empty($json) ? '[]' : $json ;
        $search = array('\\',"\n","\r","\f","\t","\b") ;
        $replace = array('\\\\',"\\n", "\\r","\\f","\\t","\\b");
        $json = str_replace($search,$replace,$json);
        return $json;
    }

    static function isJSON($str=NULL) {
        if (is_string($str)) {
            @json_decode($str);
            return (json_last_error() === JSON_ERROR_NONE);
        }
        return false;
    }

    static function url_exists($url) {
        $h = get_headers($url);
        $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
        return ($status[1] == 200);
    }

    static public function roundValueOfReviews($ratting){
        if($ratting && $ratting >1 ){
            if(strpos($ratting, ".")){
                $ratting = explode(".", $ratting);
                if($ratting[1]>5){
                    return number_format($ratting[0].".5", 1);
                }else{
                    return number_format($ratting[0], 1);
                }
            }
        }elseif($ratting < 1 && $ratting > 0.5 ){
            return number_format(1,1);
        }elseif($ratting < 0.5){
            return number_format(0.5,1);
        }
        return 0.0;
    }
}