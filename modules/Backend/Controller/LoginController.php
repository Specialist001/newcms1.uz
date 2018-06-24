<?php
namespace Modules\Backend\Controller;

use Limber\Http\Input;
use Limber\Http\Redirect;
use Limber\Localization\I18n;
use Limber\Routing\Controller;
use Limber\Auth\Auth;
use Limber\Template\View;
use Modules;

class LoginController extends Controller
{
    public $layout = 'login';

    public function __construct()
    {
        if (Auth::authorized()) {
            Redirect::go('/Backend/');
        }

        I18n::instance()
            ->load('dashboard/main')
            ->load('dashboard/login');
    }

    public function form()
    {
        return View::make('login');
    }

    public function auth()
    {
        $params    = Input::post();
        $userModel = new Modules\Admin\Model\User();
        $user      = $userModel->getUserByParams($params);

        if ($user) {
            if ($user->getAttribute('role') == 'Backend') {
                Auth::authorize($user);
                Redirect::go('/Backend/login/');
            }
        }

        echo 'Incorrect email or password.';
        exit;
    }
}