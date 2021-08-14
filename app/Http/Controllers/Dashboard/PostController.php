<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            if(!empty($request->search)){
                $model = Post::where('title' ,'like' ,'%' . $request->search . '%')
                    ->orWhere('description' ,'like' ,'%' . $request->search . '%')
                    ->orWhere('job_type' , 'like' , '%' . $request->search . '%');
            } else {
                $model = Post::query();
            }
                return DataTables::eloquent($model)
                ->addColumn('company_name' , function(Post $post){
                    return $post->company->name;
                })
                ->addColumn('job_role' , function(Post $post){
                    return $post->jobRoles->name;
                })
                ->addColumn('action', function($row){
                    $btn = '<a class="info btn btn-info btn-lg" style="margin:5px; color: #FFF;"' . (auth()->user()->can("post show") ? (" href='"  . route('post.show' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-eye"></i>'  .  __("site.show") .'</a>';
                    if($row->is_approved)
                        $btn = $btn . '<a class="info btn btn-danger btn-lg" style="margin:5px; color: #FFF;"' . (auth()->user()->can("post show") ? (" href='"  . route('post.approve' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-times"></i>'  .  __("site.unapprove") .'</a>';
                    else
                        $btn = $btn . '<a class="info btn btn-secondary btn-lg" style="margin:5px; color: #FFF;"' . (auth()->user()->can("post show") ? (" href='"  . route('post.approve' , $row->id) . "'")   : "disabled") . ' ><i class="fa fa-check"></i>'  .  __("site.approve") .'</a>';
                    return $btn;
            })
            ->editColumn('created_at', function (Post $post) {
                return $post->created_at->format('Y-m-d h:i'); // human readable format
              })
            ->rawColumns(['action'])
            ->filter(function($instance) use ($request){
                if($request->status == 'approved'){
                    $instance->where('is_approved' , 1);
                }elseif($request->status == 'unapproved'){
                    $instance->where('is_approved' , 0);
                }else{

                }
            })
            ->toJson();
        }
        return view('Dashboard.Post.index');
    }

    public function show(Post $post){
        $post->load(['company' , 'jobRoles' , 'tags' , 'userReaction']);
        return view('dashboard.post.show' , compact('post'));
    }

    public function approveToggle(Post $post){
        $approve_status = $post->is_approved;
        if($approve_status){
            $post->is_approved = 0;
        } else {
            $post->is_approved = 1;
        }
        $post->save();
        return view('Dashboard.Post.index');
    }
}
