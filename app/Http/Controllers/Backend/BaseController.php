<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct ()
    {
        $this->image_path = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $this->folder_name . DIRECTORY_SEPARATOR;
        $this->file_path = public_path() . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . $this->folder_name . DIRECTORY_SEPARATOR;
    }

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

    protected function uploadImage(Request $request,$image_field_name)
    {
        $image      = $request->file($image_field_name);
        $image_name = rand(6785, 9814).'_'.$image->getClientOriginalName();
        $image->move($this->image_path, $image_name);
        return $image_name;
    }

    protected function deleteImage($image)
    {
        $image_name = $this->image_path .$image;
        if (is_file($image_name)){
            unlink($image_name);
        }
    }

}
