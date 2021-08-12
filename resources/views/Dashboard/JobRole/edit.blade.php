@extends('layouts.root')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.job_role')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('jobRole.index') }}"> @lang('site.job_role')</a></li>
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
                    <form action="{{ route('jobRole.update', $jobRole->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('site.table.namear')</label>
                            <input type="text" name="name_ar" class="form-control" value="{{old('namear' , $jobRole->translate('ar')->name)}}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.table.nameen')</label>
                            <input type="text" name="name_en" class="form-control" value="{{old('namear' , $jobRole->translate('en')->name)}}">
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
