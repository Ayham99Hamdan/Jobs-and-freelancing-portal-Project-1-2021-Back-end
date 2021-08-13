<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index(Request $request){ 
        if($request->ajax()){
            if(!empty($request->search)){
                $model = Admin::where('first_name' ,'like' ,'%' . $request->search . '%')
                    ->orWhere('last_name' ,'like' ,'%' . $request->search . '%');
            } else {
                $model = Admin::query();
            }
                return DataTables::eloquent($model)
                ->addColumn('avatar' , function(Admin $admin){
                    return "<img src="  . $admin->avatar_path . " class='img-thumbnail' style='width:100px;'>";
                })
                ->addColumn('action', function($row){
                    $btn = '<a href=" ' . route('admin.edit' , $row->id) . '" class="edit btn btn-success btn-lg" style="margin:5px;"" ><i class="fa fa-edit"></i>'  .  __("site.edit") .'</a>';
                    $btn = $btn.'<form style="display: inline-block;" class="delete" action=" ' . route('admin.delete' , $row->id) . ' " method="post" >
                    '. csrf_field() . '
                    '. method_field("delete") .'
                    <button type="submit" class="btn btn-danger delete btn-lg" onclick="deleteElement(event)"><i class="fa fa-trash"></i> ' . __("site.delete") . '</button>';

                    return $btn;
            })
            ->editColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d h:i'); // human readable format
              })
            ->rawColumns(['avatar' , 'action'])
            ->toJson();
        }
        return view('Dashboard.Admin.index');
    }
    public function create(){
        return view('Dashboard.Admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|min:8|confirmed',
            'email' => ['required' , Rule::unique('admins' , 'email')],
            'image' => 'image'
        ]);

        if ($request->image) {

            Image::make($request->image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/admin_images/') . $request->image->hashName());

            $request['avatar'] = $request->image->hashName();
        }
        $request['password'] = bcrypt($request->password);
        Admin::create($request->toArray())
        ->assignRole('admin')
        ->givePermissionTo($request->permissions);

        return redirect()->route('admin.index');
    }

    public function edit(Admin $admin){
        
        return view('Dashboard.admin.edit' , compact('admin'));
    }

    public function update(Request $request , admin $admin){

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => ['required' , Rule::unique('admins')->ignore($admin->id)],
             'image' => 'image'
        ]);
        if($request->image){
            if($admin->avatar != 'default.png'){
                Storage::disk('public_uploads')->delete('/admin_images/' . $admin->avatar);
            }
            Image::make($request->image)->resize(300, null ,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/admin_images/') . $request->image->hashName());
            $request['avatar'] = $request->image->hashName();
        }
        
        $admin->syncPermissions($request->permissions);
        $admin->update($request->toArray());
        $admin->save();
        session()->flash('success' ,__('site.updated_successfully'));
        return redirect()->route('admin.index');
    }

    public function delete(Admin $admin){
        if($admin->avatar != 'default.png')
        Storage::disk('public_uploads')->delete('/admin_images/' . $admin->avatar);
        $admin->delete();
        session()->flash('success' , __('site.deleted_successfully'));
        return redirect()->route('admin.index');
    }
}
