@extends('layouts.root')

@section('content')
<table class="table table-bordered data-table" style="color: #FFF;">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Name Arabic</th>
            <th>create_at</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('h') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'namear', name: 'namear'},
                {data: 'created_at', name: 'created_at'},
            ]
        });
    });
</script>
@endpush

