<?php
namespace Limber\Cms\Front\Controller;

use View;

class HomeController extends FrontController
{
    public function index()
    {
        return View::make('index');
    }
}