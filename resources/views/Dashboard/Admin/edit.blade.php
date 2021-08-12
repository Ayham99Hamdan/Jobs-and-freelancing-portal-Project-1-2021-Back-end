@extends('layouts.root')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.admin')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('admin.index') }}"> @lang('site.admins')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')
                    <form action="{{ route('admin.update', $admin->id) }}" method="post" enctype="multipart/form-data" >

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.first_name')</label>
                            <input type="text" name="first_name" class="form-control" value="{{old('first_name' , $admin->first_name)}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.last_name')</label>
                            <input type="text" name="last_name" class="form-control" value="{{old('last_name' , $admin->last_name)}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" class="form-control" value="{{old('email' , $admin->email)}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                            <img src="{{$admin->avatar_path}} " class="img-thumbnail image-preview" style="width: 100px">
                        </div>

                        @php
                            $models = ['qualification' , 'job_role'];
                            $maps = ['create' , 'update' , 'read' , 'delete'];
                        @endphp

                        <ul class="nav nav-tabs">
                            @foreach ($models as $index => $model)
                            <li class={{$index == 0 ? 'active' : ''}}> <a href="#{{$model}}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($models as $index => $model)
                                <div class="tab-pane {{$index == 0 ? 'active' : ''}} " id="{{$model}}">
                                    @foreach ($maps as $map)
                                        <label><input type="checkbox" name="permissions[]" value="{{$model . ' ' . $map}}" @if ($admin->hasPermissionTo($model . ' ' . $map))
                                          checked  
                                        @endif> {{$map}}</label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
