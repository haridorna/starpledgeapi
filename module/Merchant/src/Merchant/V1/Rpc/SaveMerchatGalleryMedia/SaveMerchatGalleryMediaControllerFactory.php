<?php
namespace Merchant\V1\Rpc\SaveMerchatGalleryMedia;

class SaveMerchatGalleryMediaControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveMerchatGalleryMediaController();
    }
}
