<?php
namespace Limber\Template\Extension;

use Modules\Front\Classes\Resource;
use Twig_Extension;
use Twig_SimpleFunction;

class ResourceExtension extends Twig_Extension
{
    public function getName()
    {
        return 'TwigResourceExtensions';
    }

    public function getFunctions()
    {
        $functions   = [];
        $functions[] = new Twig_SimpleFunction('resources', array($this, 'getResources'));
        $functions[] = new Twig_SimpleFunction('next_resource_by_id', array($this, 'getNextById'));
        $functions[] = new Twig_SimpleFunction('prev_resource_by_id', array($this, 'getPrevById'));
        return $functions;
    }

    public function getPrevById(int $resourceId)
    {
        $resourceModel = new \Modules\Front\Model\Resource;
        return $resourceModel->getPrevResource($resourceId);
    }

    public function getNextById(int $resourceId)
    {
        $resourceModel = new \Modules\Front\Model\Resource;
        return $resourceModel->getNextResource($resourceId);
    }

    public function getResources(int $typeId, array $params = [])
    {
        $resourceModel = new \Modules\Front\Model\Resource;
        return $resourceModel->getResources($typeId, $params);
    }
}