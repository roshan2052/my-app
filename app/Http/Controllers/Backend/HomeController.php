<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
    protected $panel = 'Test';
    protected $view_path = 'backend.dashboard.';
    protected $base_route = 'backend.dashboard.';
    protected $folder_name = 'Home';
    protected $page_title, $model;

    public function index()
    {
        $data = [];
        return view($this->__loadDataToView($this->view_path . 'index'),compact('data'));
    }

}
