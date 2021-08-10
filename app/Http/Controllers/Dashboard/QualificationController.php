<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\QualificationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QualificationController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $model = Qualification::with('translations');
            return DataTables::eloquent($model)
            ->addColumn('namear' , function(Qualification $model){
                return $model->translate('ar')->name;
            })
            ->addColumn('nameen' , function(Qualification $model){
                return $model->translate('en')->name;
            })->toJson();
        }
        return view('Dashboard.Qualification');
    }
}
