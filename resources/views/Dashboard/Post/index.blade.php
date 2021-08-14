 @extends('layouts.root')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.posts')</h1>

            <ol class="breadcrumb">

            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.posts')</li>
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
                            <th>@lang('site.company_name')</th>
                            <th>@lang('site.job_role')</th>
                            <th style="width: 3%">@lang('site.title')</th>
                            <th style="width: 3%">@lang('site.job_type')</th>
                            <th style="width: 25%">@lang('site.description')</th>
                            <th>@lang('site.start_salary')</th>
                            <th>@lang('site.end_salary')</th>
                            <th>@lang('site.experience_years')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.approve')</th>
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
        function fill(search = '' , filter = 'all'){
            $('.data-table').DataTable({
            searching:false,
            processing: false,
            serverSide: true,
            ajax: {
                url:"{{ route('post.index') }}",
                data : {
                    search:search,
                    status:filter
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'company_name', name: 'company_name'},
                {data: 'job_role', name: 'job_role'},
                {data: 'title', name: 'title'},
                {data: 'job_type', name: 'jop_type'},
                {data: 'description', name: 'description'},
                {data: 'start_salary', name: 'start_salary'},
                {data: 'end_salary', name: 'end_salary'},
                {data: 'experience_years', name: 'experience_years'},
                {data: 'created_at', name: 'created_at'},
                {data: 'is_approved', name: 'is_approved'},
                {data: 'action' , name: 'actions'}
            ]
        });
        }
        $('.search').on('input' , function(){
            $('.data-table').DataTable().destroy();
            fill($(this).val());
        });
        $('.filter').on('change' , function(){
            $('.data-table').DataTable().destroy();
            var search_value = $('.search').val();
            fill(search_value , $(this).val());
        });
    });
</script>
@endpush

