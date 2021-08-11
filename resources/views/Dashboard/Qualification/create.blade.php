@extends('layouts.root')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.qualification')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('qualification.index') }}"> @lang('site.qualification')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('qualification.store') }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label>@lang('site.table.namear')</label>
                        <input type="text" name="name_ar" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.table.nameen')</label>
                        <input type="text" name="name_en" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->
@endsection
