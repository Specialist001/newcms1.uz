<?php
namespace Modules\Frontend\Controller;

use View;

class HomeController extends FrontendController
{
    public function index()
    {
        return View::make('main');
    }
}