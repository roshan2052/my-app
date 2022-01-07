<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

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
        $image_name = time().'_'.$image->getClientOriginalName();
        $image->move($this->image_path, $image_name);
        if($dimensions = config('image_resize.image_dimensions.' . $this->folder_name . '.image')) {
            foreach ($dimensions as $dimension) {
                // open and resize an image file
                $img = Image::make($this->image_path.$image_name)->resize($dimension['width'], $dimension['height']);
                // save the same file as jpg with default quality
                $img->save($this->image_path.$dimension['width'].'_'.$dimension['height'].'_'.$image_name);
            }
        }
        return $image_name;
    }

    protected function deleteImage($image_name)
    {
        $image = $this->image_path .$image_name;
        if (is_file($image)){
            unlink($image);
            if($dimensions = config('image_resize.image_dimensions.' . $this->folder_name . '.image')) {
                foreach ($dimensions as $dimension) {
                    $resized_image = $this->image_path.$dimension['width'].'_'.$dimension['height'].'_'.$image_name;
                    if (is_file($resized_image)) {
                        unlink($resized_image);
                    }
                }
            }
        }
    }

}
