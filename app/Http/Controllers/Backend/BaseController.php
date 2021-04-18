<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BackendBaseController extends Controller
{

    protected  function  __loadDataToView($viewPath){
        view()->composer($viewPath, function ($view) {
            $view->with('panel', $this->panel);
            $view->with('base_route', $this->base_route);
            $view->with('view_path', $this->view_path);
            $view->with('folder_name', $this->folder_name);
            if (isset($this->page_title)){
                $view->with('page_title', $this->page_title);
            }
        });
        return $viewPath;
    }

}
