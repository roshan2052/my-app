<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\TestRequest;
use App\Models\Test;
use App\Models\Testing;
use Illuminate\Http\Request;
use App\Services\ConstantMessageService;
use App\Services\TestingService;

class TestingController extends BaseController
{

    protected $panel = 'Testing';
    protected $view_path = 'backend.testing.';
    protected $base_route = 'backend.testing.';
    protected $folder_name = 'testing';
    protected $page_title, $model, $testingService;

    public function __construct(Testing $testing,TestingService $testingService)
    {
        parent::__construct();
        $this->model = $testing;
        $this->testingService = $testingService;
    }

    public function index()
    {
        $this->page_title  = 'List '.$this->panel;
        $data =  [];
        return view($this->__loadDataToView($this->view_path . 'index'),compact('data'));
    }

    public function getTestingDataForDataTable(Request $request)
    {
        return $this->testingService->getDataForDataTable($request);
    }


    public function create()
    {
        $this->page_title  = 'Create '.$this->panel;
        $data['tests'] = Test::pluck('title','id');

        return view($this->__loadDataToView($this->view_path . 'create'),compact('data'));
    }


    public function store(Request $request)
    {
        if ($request->hasFile('image_name')) {
            $image = $this->uploadImage($request,'image_name');
            $request->request->add(['image' => $image]);
        }
        try{
            $request->request->add(['created_by' => auth()->user()->id]);
            $this->model->create($request->all());
            toast(ConstantMessageService::CREATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast(ConstantMessageService::CREATE_FAIL,'error','top-right');
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
        return view($this->__loadDataToView($this->view_path . 'show'),compact('data'));
    }


    public function edit($id)
    {
        $this->page_title  = 'Edit '.$this->panel;

        if (!$data['row'] = $this->model->find($id)){
            toast($this->panel.' '.ConstantMessageService::EDIT_FAIL,'error','top-right');
            return redirect() -> route($this->base_route . 'index');
        }

        $data['tests'] = Test::pluck('title','id');

        return view($this->__loadDataToView($this->view_path . 'edit'),compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data['row'] = $this->model->findorFail($id);
        if ($request->hasFile('image_name')) {
            $image = $this->uploadImage($request,'image_name');
            $request->request->add(['image' => $image]);
            if($data['row']->image){
                $this->deleteImage($data['row']->image);
            }
        }
        try{
            $request->request->add(['updated_by' => auth()->user()->id]);
            $data['row']->update($request->all());
            toast(ConstantMessageService::UPDATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast(ConstantMessageService::UPDATE_FAIL,'error','top-right');
        }
        return redirect()->route($this->base_route . 'index');
    }

    public function destroy($id)
    {
        $data['row'] = $this->model->findorFail($id);
        try {
            $data['row']->delete();
            toast(ConstantMessageService::DELETE,'success','top-right');
        } catch (\Exception $e) {
            toast(ConstantMessageService::DELETE_FAIL,'error','top-right');
        }
        return redirect()->route($this->base_route . 'index');
    }
}
