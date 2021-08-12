<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobRole;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobRoleController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            if(!empty($request->search)){
                $model = JobRole::with('translations')->whereTranslationLike('name' , '%' . $request->search . '%');
            } else {
                $model = JobRole::with('translations');
            }
                return DataTables::eloquent($model)
                ->addColumn('namear' , function(JobRole $model){
                    return $model->translate('ar')->name;
                })
                ->addColumn('nameen' , function(JobRole $model){
                    return $model->translate('en')->name;
                })->addColumn('action', function($row){
                    $btn = '<a  class="edit btn btn-primary btn-lg" ' . (auth()->user()->can("job_role update") ? (" href = '"  . route('jobRole.edit' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-edit"></i>'  .  __("site.edit") .'</a>';
                    $btn = $btn.'<form style="display: inline-block;" class="delete" action=" ' . route('jobRole.delete' , $row->id) . ' " method="post" >
                    '. csrf_field() . '
                    '. method_field("delete") .'
                    <button type="submit" class="btn btn-danger delete btn-lg" onclick="deleteElement(event)" ' . (auth()->user()->can("job_role delete") ? "" : "disabled") . '><i class="fa fa-trash"></i> ' . __("site.delete") . '</button>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('Dashboard.JobRole.index');
    }

    public function create(){
        return view('Dashboard.JobRole.create');
    }

    public function store(Request $request){


        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);
        JobRole::create([
            'name:ar' => $request->name_ar,
            'name:en' => $request->name_en
        ]);

        return redirect()->route('jobRole.index');
    }

    public function edit(JobRole $jobRole){
        return view('Dashboard.JobRole.edit' , compact('jobRole'));
    }

    public function update(Request $request , JobRole $jobRole){

        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);

        $jobRole->update([
            'name:ar' => $request->name_ar,
            'name:en' => $request->name_en
        ]);

        $jobRole->save();
        session()->flash('success' ,__('site.updated_successfully'));
        return redirect()->route('jobRole.index');
    }

    public function delete(JobRole $jobRole){
        $jobRole->delete();
        session()->flash('success' , __('site.deleted_successfully'));
        return redirect()->route('jobRole.index');
    }
}
