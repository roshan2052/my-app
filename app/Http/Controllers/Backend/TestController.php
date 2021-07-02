<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Services\ConstantMessageService;

class TestController extends BaseController
{

    protected $panel = 'Test';
    protected $view_path = 'backend.test.';
    protected $base_route = 'backend.test.';
    protected $folder_name = 'test';
    protected $page_title, $model;

    public function __construct(Test $test)
    {
        $this->model = $test;
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


    public function store(TestRequest $request)
    {
        try{
            $request->request->add(['created_by' => auth()->user()->id]);
            $this->model->create($request->all());
            toast(ConstantMessageService::CREATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast(ConstantMessageService::CREATE_FAIL,'error','top-right');
        }
        return redirect() -> route($this->base_route . 'index');
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

        return view($this->__loadDataToView($this->view_path . 'edit'),compact('data'));
    }

    public function update(TestRequest $request, $id)
    {
        $data['row'] = $this->model->findorFail($id);
        try{
            $request->request->add(['updated_by' => auth()->user()->id]);
            $data['row']->update($request->all());
            toast(ConstantMessageService::UPDATE,'success','top-right');
        }
        catch (\Exception $e) {
            toast(ConstantMessageService::UPDATE_FAIL,'error','top-right');
        }
        return redirect() -> route($this->base_route . 'index');
    }

    public function destroy($id)
    {
        $data['row'] = $this->model->findorFail($id);
        try {
            $data['row']->delete();
            toast(ConstantMessageService::DELETE,'success','top-right');
        } catch (Exception $e) {
            toast(ConstantMessageService::DELETE_FAIL,'error','top-right');
        }
        return redirect() -> route($this->base_route . 'index');
    }
}
