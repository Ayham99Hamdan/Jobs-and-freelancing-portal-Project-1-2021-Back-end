@extends('layouts.root')

@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.qualification')</h1>

        <ol class="breadcrumb">
            {{-- <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li> --}}
            <li class="active">@lang('site.qualification')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                {{-- <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products') <small>{{ $products->total()}}</small></h3> --}}

            </div><!-- end of box header -->

            <div class="box-body">

                <table class="table table-bordered data-table" style="color: #000;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.table.namear')</th>
                            <th>@lang('site.table.nameen')</th>
                            <th>@lang('site.table.created_at')</th>
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
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('qualification.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'namear', name: 'namear'},
                {data: 'nameen', name: 'nameen'},
                {data: 'created_at', name: 'created_at'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
    });
</script>
@endpush

