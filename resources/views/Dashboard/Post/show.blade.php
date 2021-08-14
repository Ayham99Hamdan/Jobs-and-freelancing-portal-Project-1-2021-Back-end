@extends('layouts.root')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            
            <h1>{{$post->company->name}}</h1>
    
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('post.index') }}">@lang('site.posts')</a></li>
                <li class="active">{{$post->company->name}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="box-header with-border">

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-6 job-primary-data">
                        <h4><span>@lang('site.company_name'):</span> {{$post->company->name}}</h4>
                        <h4><span>@lang('site.job_role'):</span> {{$post->jobRoles->name}}</h4>
                        <h4><span>@lang('site.title'):</span> {{$post->title}}</h4>
                        <h4><span>@lang('site.job_type'):</span> {{$post->job_type}}</h4>
                        <h4><span>@lang('site.user_reaction_count'):</span> {{$post->userReaction->count()}}</h4>
                        <h4><span>@lang('site.start_salary'):</span> {{$post->start_salary}}</h4>
                        <h4><span>@lang('site.end_salary'):</span> {{$post->end_salary}}</h4>
                        <h4><span>@lang('site.experience_years'):</span> {{$post->experience_years}}</h4>
                        <h4 class="description"><span>@lang('site.description'): <br></span> {{$post->description}}</h4>
                    </div>
                    <div class="col-6">
                        <div class="tags">
                            <h2>@lang('site.tags')</h2>
                            @foreach ($post->tags as $tag)
                            <div class="tag">{{$tag->tag}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection