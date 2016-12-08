<?php
/**
 * Project: PrivyPASS.com
 * Author: Hari Dornala
 * Date: 2/8/15
 * Time: 6:52 PM
 */

namespace Common\V1\Model;

use Aws\S3\S3Client;

/**
 * Class S3Upload
 * @package Merchant\Model
 * @author Hari Dornala
 * @date 8 Feb 2015
 */
class S3Upload
{
    private $serviceLocator;
    private $s3Client;

    /**
     * @param $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        $this->config = $serviceLocator->get('Config');
        $config       = $this->config['aws'];
        $awsConfig    = array(
            'key'    => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region']
        );

        $this->s3Client = S3Client::factory($awsConfig);
    }

    /**
     * Function: save
     * @author   Hari Dornala
     * @param $fileData
     * Format:
     * Array (
     *     [name] => json.php
     *     [type] => application/octet-stream
     *     [tmp_name] => E:\wamp\tmp\php7463.tmp
     *     [error] => 0
     *     [size] => 498
     * )
     *
     * @return array
     */
    public function save($fileData)
    {
        $error = $fileData['error'];
        if (isset($error) && $error > 0) {
            return FALSE;
        }

//        echo '<pre>'; print_r($fileData); exit;
        $ext = pathinfo($fileData['name'], PATHINFO_EXTENSION);
        $key = md5(date('Y-m-d H:i:s') . $fileData['name']) . '.' . $ext;

        $result = $this->s3Client->putObject(array(
            'Bucket'      => 'privpass.deal.media',
            'Key'         => $key,
            'ContentType' => $fileData['type'],
            'SourceFile'  => $fileData['tmp_name'],
            'ACL'         => 'public-read'
        ));

        return $result->toArray();
    }

    public function saveFromFile($filename, $ext, $bucketName='privpass.deal.media')
    {
        $key = md5(date('Y-m-d H:i:s') . $filename) . '.' . $ext;

        $result = $this->s3Client->putObject(array(
            'Bucket'      => $bucketName,
            'Key'         => $key,
            'ContentType' => "image/" . $ext,
            'SourceFile'  => $filename . "." . $ext,
          //  'Body'         => "../".$_SERVER["DOCUMENT_ROOT"]."/".$filename . "." . $ext,
            'ACL'         => 'public-read'
        ));

        return $result->toArray();
    }
} 