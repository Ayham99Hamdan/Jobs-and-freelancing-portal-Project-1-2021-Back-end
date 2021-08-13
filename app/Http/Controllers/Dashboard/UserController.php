<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToArray;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            if(!empty($request->search)){
                $model = User::where('first_name' , 'like' , '%' . $request->search . '%')
                ->orWhere('last_name' , 'like' , '%' . $request->search . '%')
                ->orwhere('email' , 'like' , '%' . $request->search . '%');
            } else {
                $model = User::query();
            }
                return DataTables::eloquent($model)
                ->addColumn('avatar' , function(User $user){
                    return "<img src="  . $user->avatar_url . " class='img-thumbnail' style='width:100px;'>";
                })
                ->addColumn('action', function($row){
                    $btn = '<a class="info btn btn-info btn-lg" style="margin:5px; color: #FFF;"' . (auth()->user()->can("user show") ? (" href='"  . route('user.show' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-view"></i>'  .  __("site.show") .'</a>';
                    return $btn;
            })
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d h:i'); // human readable format
              })
             ->rawColumns(['avatar' , 'action'])
            ->toJson();
        }
        return view('Dashboard.User.index');
    }

    public function show(User $user){
        
        $user->load(['educations.qualification' , 'experiences' , 'tags' ,'jobRole'])->toArray();
        return view('Dashboard.User.show' , compact('user'));
    }
}
