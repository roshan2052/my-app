<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Services\ConstantMessageService;
use App\Exports\UsersExport;
use App\Http\Resources\TestResource;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends BaseController
{

    protected $panel = 'Test';
    protected $view_path = 'backend.test.';
    protected $base_route = 'backend.test.';
    protected $folder_name = 'test';
    protected $page_title, $model;

    protected $request = TestRequest::class;

    protected $resource = TestResource::class;

    public function __construct(Test $test)
    {
        $this->model = $test;
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
