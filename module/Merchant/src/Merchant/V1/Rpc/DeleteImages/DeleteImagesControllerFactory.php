<?php
namespace Merchant\V1\Rpc\DeleteImages;

class DeleteImagesControllerFactory
{
    public function __invoke($controllers)
    {
        return new DeleteImagesController();
    }
}
