<?php
namespace Limber\Cms\Admin\Controller;

use Limber\Auth\Auth;
use Limber\Http\Redirect;
use Limber\Routing\Controller;
use Limber\Template\View;
use Limber\Localization\I18n;

class AdminController extends Controller
{
    public $layout = 'admin';

    public function __construct()
    {
        if (!Auth::authorized()) {
            Redirect:go('/admin/login/');
        }

        I18n::instance()
            ->load('/dashboard/main/')
            ->load('/dashboard/menu/');
    }

    public function dashboard()
    {
        return View::make('dashboard');
    }

    public function logout()
    {
        Auth::unauthorize();
        Redirect::go('/admin/login/');
    }
}