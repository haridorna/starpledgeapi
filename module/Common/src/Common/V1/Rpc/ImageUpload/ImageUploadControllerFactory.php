<?php
namespace Common\V1\Rpc\ImageUpload;

class ImageUploadControllerFactory
{
    public function __invoke($controllers)
    {
        return new ImageUploadController();
    }
}
