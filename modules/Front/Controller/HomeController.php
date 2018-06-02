<?php
namespace Modules\Front\Controller;

use View;

class HomeController extends FrontController
{
    public function index()
    {
        return View::make('main');
    }
}