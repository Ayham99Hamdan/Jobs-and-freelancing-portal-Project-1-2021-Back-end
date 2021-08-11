 @extends('layouts.root')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.admin')</h1>

        <ol class="breadcrumb">

            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.admin')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">


            </div><!-- end of box header -->

            <div class="box-body">
                <a href= "{{route('admin.create')}}"class="btn btn-primary "><i class="fa fa-plus"></i>@lang('site.add')</a>
                <div class="col-md-4">
                    <input class="search" type="text" name="search"  class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                </div>
                <table class="table table-bordered data-table" style="color: #000;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.table.created_at')</th>
                            <th>@lang('site.table.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        fill();
        function fill(search = ''){
            $('.data-table').DataTable({
            searching:false,
            processing: false,
            serverSide: true,
            ajax: {
                url:"{{ route('admin.index') }}",
                data : {search:search}
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email' , name: 'email'},
                {data: 'avatar' , name : 'avatar'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action' , name: 'actions'}
            ]
        });
        }
        $('.search').on('input' , function(){
            $('.data-table').DataTable().destroy();
            fill($(this).val());
        });

    });

</script>
@endpush

