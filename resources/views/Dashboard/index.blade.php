@extends('layouts.root')

@section('content')

    @include('partials._session')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- categories--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>10</h3>

                            <p>@lang('site.companies')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <a href="{{ route('company.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--products--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{$user_count}}</h3>

                            <p>@lang('site.employees')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="{{ route('user.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--clients--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{$post_count}}
                                <span class="more-data">
                                    @lang('site.approve') : {{$post_count_approved}}
                                    @lang('site.unapprove') : {{$post_count_unapproved}}</h3>
                                </span>
                            <p>@lang('site.post')</p>
                        </div>  
                        <div class="icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <a href="{{ route('post.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{--users--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $admin_count }}</h3>

                            <p>@lang('site.admins')</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        @if (auth()->user()->hasRole('super-admin'))
                            <a href="{{ route('admin.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>    
                        @else
                        <a href="#" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                        @endif

                        
                    </div>
                </div>

            </div><!-- end of row -->

            <div class="box box-solid">

                <div class="box-header">
                    <h3 class="box-title">
                        
                    </h3>
                </div>
                <div class="box-body border-radius-none">
                    <div id="post-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

@push('scripts')
    <script>
        var line = new Morris.Line({
            element: 'post-chart',
            data: [
                    @foreach ($post_chart as $value)
                        { ym: "{{ $value->year }}-{{ $value->month }}", value: {{$value->count}} },
                    @endforeach
                ],
                xkey: 'ym',
                ykeys: ['value'],
                labels: ['Value'],
                lineWidth: 2,
                hideHover: 'auto',
                gridStrokWidth: 0.4,
                pointSize: 4
                
        });
    </script>
@endpush
