<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use App\Services\ConstantMessageService;

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

    public function index()
    {
        $this->page_title  = 'List '.$this->panel;

        $data =  [];
        $data['rows'] = $this->model->latest()->get();

        return view($this->__loadDataToView($this->view_path . 'index'),compact('data'));
    }

    public function create()
    {
        $this->page_title  = 'Create '.$this->panel;

        return view($this->__loadDataToView($this->view_path . 'create'));
    }

    public function store()
    {
        $validatedData = resolve($this->request)->validated();
        try{
            $this->model->create($validatedData);
            toast($this->panel.' '.ConstantMessageService::CREATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast($this->panel.' '.ConstantMessageService::CREATE_FAIL,'error','top-right');
        }
        return redirect()->route($this->base_route . 'index');
    }


    public function show($id)
    {
        $this->page_title  = 'View '.$this->panel;

        if (!$data['row'] = $this->model->find($id)){
            toast($this->panel.' '.ConstantMessageService::SHOW_FAIL,'error','top-right');
            return redirect() -> route($this->base_route . 'index');
        }
        return $this->resource::make($data['row']);
        // return view($this->__loadDataToView($this->view_path . 'show'),compact('data'));
    }


    public function edit($id)
    {
        $this->page_title  = 'Edit '.$this->panel;

        if (!$data['row'] = $this->model->find($id)){
            toast($this->panel.' '.ConstantMessageService::EDIT_FAIL,'error','top-right');
            return redirect()->route($this->base_route . 'index');
        }

        return view($this->__loadDataToView($this->view_path . 'edit'),compact('data'));
    }

    public function update($id)
    {
        $validatedData = resolve($this->request)->validated();
        try{
            $data['row'] = $this->model->findorFail($id);
            $data['row']->update($validatedData);
            toast($this->panel.' '.ConstantMessageService::UPDATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast($this->panel.' '.ConstantMessageService::UPDATE_FAIL,'error','top-right');
        }
        return redirect()->route($this->base_route . 'index');
    }

    public function destroy($id)
    {
        $data['row'] = $this->model->findorFail($id);
        try {
            $data['row']->delete();
            toast($this->panel.' '.ConstantMessageService::DELETE,'success','top-right');
        } catch (\Exception $e) {
            toast($this->panel.' '.ConstantMessageService::DELETE_FAIL,'error','top-right');
        }
        return redirect()->route($this->base_route . 'index');
    }

}
