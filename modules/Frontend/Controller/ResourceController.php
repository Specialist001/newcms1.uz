<?php
namespace Modules\Frontend\Controller;

use Limber\Http\Redirect;
use Limber\Template\View;
use Modules\Frontend\Model;

class ResourceController extends FrontendController
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

        if ($resource->getAttribute('status') !== 'publish') {
            Redirect::go('/');
            }

        $templateName = $resourceType;

        if ($resource->getAttribute('type') !== 'basic') {
            $templateName .= '.' . $resource->getAttribute('type');
        }

        $this->setData('type', $resourceType);
        $this->setData($resourceType, $resource);
        return View::make($templateName, $this->data);
    }
}