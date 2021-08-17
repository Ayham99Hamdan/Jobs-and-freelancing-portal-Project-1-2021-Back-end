<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            if(!empty($request->search)){
                $model = Company::where('name' ,'like' ,'%' . $request->search . '%')
                    ->orWhere('description' ,'like' ,'%' . $request->search . '%')
                    ->orWhere('email' , 'like' , '%' . $request->search . '%');
            } else {
                $model = Company::query();
            }
                return DataTables::eloquent($model)
                ->addColumn('job_role' , function(Company $company){
                    return $company->jobRole->name;
                })
            //     ->addColumn('action', function($row){
            //         $btn = '<a class="info btn btn-info btn-lg" style="margin:5px; color: #FFF;"' . (auth()->user()->can("company show") ? (" href='"  . route('post.show' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-eye"></i>'  .  __("site.show") .'</a>';
            //         return $btn;
            // })
            ->addColumn('avatar', function(Company $company){
                return '<img src="' . $company->avatar_path . '" class="img-thumbnail" style="width:100px">';
            })
            ->editColumn('created_at', function (Company $company) {
                return $company->created_at->format('Y-m-d h:i'); // human readable format
              })
            ->rawColumns(['avatar'])
            ->toJson();
        }
        return view('Dashboard.company.index');
    }
}
