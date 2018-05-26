<?php
namespace Modules\Admin\Controller;

use Limber\Auth\Auth;
use Limber\Http\Redirect;
use Limber\Routing\Controller;
use Limber\Template\View;
use Limber\Localization\I18n;
use Modules\Admin\Model\ResourceType as ResourceTypeModel;

class AdminController extends Controller
{
    //public $layout = 'admin';

    //public $theme  = 'admin';

    public function __construct()
    {
        if (!Auth::authorized()) {
            Redirect::go('/admin/login/');
        }

        I18n::instance()
            ->load('dashboard/main', 'Admin')
            ->load('dashboard/menu', 'Admin');

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
        Redirect::go('/admin/login/');
    }
}