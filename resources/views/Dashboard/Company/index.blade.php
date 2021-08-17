 @extends('layouts.root')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.comopanies')</h1>

            <ol class="breadcrumb">

            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.companies')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">


            </div><!-- end of box header -->

            <div class="box-body">
                <div class="col-md-4">
                    <input class="search" type="text" name="search"  class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                    <select name="filter" class="filter">
                        <option value="all">All</option>
                        <option value="approved">Approved</option>
                        <option value="unapproved">Unapproved</option>
                    </select>
                </div>
                <table class="table table-bordered data-table" style="color: #000;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.job_role')</th>
                            <th style="width: 25%">@lang('site.description')</th>
                            <th>@lang('site.created_at')</th>
                            {{-- <th>@lang('site.table.actions')</th> --}}
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
                url:"{{ route('company.index') }}",
                data : {
                    search:search
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'avatar', name: 'avatar'},
                {data: 'job_role', name: 'job_role'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
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

