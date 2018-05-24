<?php
namespace Modules\Front\Controller;

use Limber\Template\View;
use Modules\Front\Model;

class ResourceController extends FrontController
{
    /**
     * @var Model\Resource
     */
    protected $resourceModel;
    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->resourceModel = new Model\Resource();
        parent::__construct();
    }
    public function show(string $resourceType, $segment)
    {
        $resource = $this->resourceModel->getResourceBySegment($segment);
        print_r($resource);
        return View::make('page', $this->data);
    }
}