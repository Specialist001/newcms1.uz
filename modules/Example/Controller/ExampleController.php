<?php
namespace Modules\Example\Controller;

use Controller;
use View;

class ExampleController extends Controller
{
    public function index()
    {
        return View::make('welcome');
    }
}