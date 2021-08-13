@extends('layouts.root')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">

            <h1>{{$user->full_name}}</h1>
    
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('user.index') }}">@lang('site.employees')</a></li>
                <li class="active">{{$user->full_name}}</li>
            </ol>
        </section>
        <section class="content">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-6 row primary-info">
                        <div class="col-3">
                            <img src="{{$user->avatar_url}}" width="100px" height="100px" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-6">
                            <h2>@lang('site.full_name') : {{$user->full_name}}</h2>
                            <h3>@lang('site.email') : {{$user->email}}</h3>
                            <h3>@lang('site.phone') : {{$user->phone}}</h3>
                            <h3>@lang('site.gender') : {{$user->gender}}</h3>
                            @if (isset($use->jobRole))
                                <h3>@lang('site.job_role') : {{$user->jobRole->name}}</h3>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tags">
                            <h2>@lang('site.tags')</h2>
                            @foreach ($user->tags as $tag)
                            <div class="tag">{{$tag->tag}}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div><!-- end of box header -->

            <div class="box-body">
                <div class="row">
                    <div class="col-6 educations">
                        <h2>@lang('site.educations')</h2>
                        @foreach ($user->educations as $education)
                            <div class="education">
                                <h4><span>@lang('site.qualification') </span>: {{$education->qualification->name}}</h4>
                                <h4><span>@lang('site.instituation_name')</span> : {{$education->instituation_name}}</h4>
                                <h4><span>@lang('site.study_field') </span> : {{$education->study_field}}</h4>
                                <h4><span>@lang('site.graduation_rate') </span> : {{$education->graduation_rate}} %</h4>
                                <h4><span>@lang('site.start_date') </span> : {{date('Y-M-d', strtotime($education->start_date))}}</h4>
                                <h4><span>@lang('site.end_date') </span> : {{$education->end_date == null ? "Until Now" : date('Y-M-d' , strtotime($education->end_date))}}</h4>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-6 experiences">
                        <h2>@lang('site.experiences')</h2>
                        @foreach ($user->experiences as $experience)
                        <div class="experience">
                            <h4><span>@lang('site.job_title') </span>: {{$experience->job_title}}</h4>
                            <h4><span>@lang('site.company_name') </span>: {{$experience->company_name}}</h4>
                            <h4><span>@lang('site.job_role') </span>: {{$experience->jobRole->name}}</h4>
                            <h4><span>@lang('site.start_date') </span>: {{date('Y-M-d' , strtotime($experience->start_date))}}</h4>
                            <h4><span>@lang('site.end_date') </span>: {{date('Y-M-d' , strtotime($experience->end_date))}}</h4>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- end of box body -->
        </section>
    </div>

@endsection

