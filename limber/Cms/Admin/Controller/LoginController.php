<?php
namespace Limber\Cms\Admin\Controller;

use Flexi\Http\Input;
use Flexi\Http\Redirect;
use Flexi\Routing\Controller;
use Flexi\Auth\Auth;
use Flexi\Template\View;

class LoginController extends Controller
{
    public $layout = 'login';

    public function __construct()
    {
        if (Auth::authorized()) {
            Redirect:go('/admin/');
        }
    }

    public function form()
    {
        return View::make('login');
    }

    public function authAdmin()
    {
        $params    = Input::post();
        $userModel = new \Limber\Cms\Admin\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'admin') {
                Auth::authorize($user);
                Redirect:go('/admin/login/');
            }
        }

        echo 'Incorrect email or password.';
    }
}