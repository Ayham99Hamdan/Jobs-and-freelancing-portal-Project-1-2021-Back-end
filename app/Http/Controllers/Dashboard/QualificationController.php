<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QualificationController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            if(!empty($request->search)){
                $model = Qualification::with('translations')->whereTranslationLike('name' , '%' . $request->search . '%');
            } else {
                $model = Qualification::with('translations');
            }
                return DataTables::eloquent($model)
                ->addColumn('namear' , function(Qualification $model){
                    return $model->translate('ar')->name;
                })
                ->addColumn('nameen' , function(Qualification $model){
                    return $model->translate('en')->name;
                })->addColumn('action', function($row){
                    $btn = '<a href=" ' . route('qualification.edit' , $row->id) . '" class="edit btn btn-primary btn-lg" ><i class="fa fa-edit"></i>'  .  __("site.edit") .'</a>';
                    $btn = $btn.'<form style="display: inline-block;" action=" ' . route('qualification.delete' , $row->id) . ' " method="post" >
                    '. csrf_field() . '
                    '. method_field("delete") .'
                    <button type="submit" class="btn btn-danger delete btn-lg"><i class="fa fa-trash"></i> ' . __("site.delete") . '</button>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('Dashboard.Qualification.index');
    }
    public function create(){
        return view('Dashboard.Qualification.create');
    }

    public function store(Request $request){


        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);
        Qualification::create([
            'name:ar' => $request->name_ar,
            'name:en' => $request->name_en
        ]);

        return redirect()->route('qualification.index');
    }

    public function edit(Qualification $qualification){
        return view('Dashboard.Qualification.edit' , compact('qualification'));
    }

    public function update(Request $request , Qualification $qualification){

        $request->validate([
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ]);

        $qualification->update([
            'name:ar' => $request->name_ar,
            'name:en' => $request->name_en
        ]);

        $qualification->save();
        session()->flash('success' ,__('site.updated_successfully'));
        return redirect()->route('qualification.index');
    }

    public function delete(Qualification $qualification){
        $qualification->delete();
        session()->flash('success' , __('site.deleted_successfully'));
        return redirect()->route('qualification.index');
    }
}
