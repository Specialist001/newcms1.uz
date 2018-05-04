<?php
namespace Limber\Cms\Admin\Controller;

use Limber\Http\Input;
use Limber\Http\Redirect;
use Limber\Localization\I18n;
use Limber\Routing\Controller;
use Limber\Auth\Auth;
use Limber\Template\View;
use Limber\Cms;

class LoginController extends Controller
{
    public $layout = 'login';

    public function __construct()
    {
        if (Auth::authorized()) {
            Redirect::go('/admin/');
        }

        I18n::instance()
            ->load('dashboard/main')
            ->load('dashboard/login');
    }

    public function form()
    {
        return View::make('login');
    }

    public function authAdmin()
    {
        $params    = Input::post();
        $userModel = new Cms\Admin\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'admin') {
                Auth::authorize($user);
                Redirect::go('/admin/login/');
            }
        }

        echo 'Incorrect email or password.';
        exit;
    }
}