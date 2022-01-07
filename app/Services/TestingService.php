<?php

namespace App\Services;

use App\Models\Testing;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class TestingService
{
    protected $model;
    protected $dataTables;

    public function __construct(Testing $testing, DataTables $dataTables)
    {
        $this->model = $testing;
        $this->dataTables = $dataTables;
    }

    public function getDataForDataTable(Request $request)
    {
        return $this->dataTables::of($this->model->with('test')->latest())
            ->editColumn('test', function($testing){
                return $testing->test->title;
            })
            ->editColumn('title', function($testing){
                return $testing->title ? $testing->title : 'N/A';
            })
            ->editColumn('created_at', function($testing){
                return $testing->created_at->format('Y-m-d');
            })
            ->editColumn('status', function($testing){
                return $testing->status == 'publish' ? '<span class="text text-success">publish</span>' : '<span class="text text-danger">unpublish</span>';
            })
            ->editColumn('image', function($testing){
                return $testing->image ?  "<img src=".asset('images/testing').'/'.$testing->image." class='rounded' alt='image' width='50' height='50'>" : 'No Image';
            })
            ->addColumn('action', function($model){
                $params = [
                    'edit'          => true,
                    'show'          => true,
                    'delete'        => true,
                    'base_route'    => 'backend.testing.',
                    'id'            => $model->id,
                ];
                return view('backend.datatable.action', compact('params'));
            })
            ->rawColumns(['action', 'status','image'])
            ->addIndexColumn()
            ->make(true);
    }

}
?>
