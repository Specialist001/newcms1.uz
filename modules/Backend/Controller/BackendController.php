<?php
namespace Modules\Backend\Controller;

use Limber\Auth\Auth;
use Limber\Http\Redirect;
use Limber\Limber;
use Limber\Routing\Controller;
use Limber\Template\View;
use Limber\Localization\I18n;
use Modules\Backend\Model\ResourceType as ResourceTypeModel;

class BackendController extends Controller
{
    //public $layout = 'admin';

    //public $theme  = 'admin';

    public function __construct()
    {
        if (!Auth::authorized()) {
            Redirect::go('/backend/login/');
        }

        I18n::instance()
            ->load('dashboard/main', 'Backend')
            ->load('dashboard/menu', 'Backend');

        $resourceTypeModel = new ResourceTypeModel();

        $this->setData('navigation', \Customize::instance()->getAdminMenuItems());
        $this->setData('resourcesType', $resourceTypeModel->getResourcesType());
    }

    public function dashboard()
    {
        return View::make('dashboard', $this->data);
    }

    public function logout()
    {
        Auth::unauthorize();
        Redirect::go('/backend/login/');
    }
}