<?php
/**
 * Created by PhpStorm.
 * User: rajesh
 * Date: 11/13/2015
 * Time: 4:45 PM
 */

namespace Common\V1\Model\PrivpassTemplates;

use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver;

class Templates {

    public function getEmailTemplat($template_name, $templateArray){
        $stack = new Resolver\TemplatePathStack(array('script_paths' => array(APPLICATION_PATH. '/module/Common/view/EmailTemplates')));

        //create a Resolver
        $resolver = new Resolver\AggregateResolver();
        $resolver->attach($stack);

        //create a Renderer
        $renderer = new PhpRenderer();
        $renderer->setResolver($resolver);

        $temp = $renderer->partial($template_name , $templateArray);

        return $temp;
    }
}