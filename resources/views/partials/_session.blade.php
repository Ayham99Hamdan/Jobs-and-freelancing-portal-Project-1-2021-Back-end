@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>
@endif

@if (session('deleted'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: "{{ session('deleted') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>
@endif

@if (session('access_denied'))

    <script>
        new Noty({
            type: 'warning',// success, error, warning, information, notification
            layout: 'topRight',
            text: "{{ session('access_denied') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif



@if (session('delete'))

<script>
    new Noty({
        type: 'error',// success, error, warning, information, notification
        layout: 'topRight',
        text: "{{ session('delete') }}",
        timeout: 2000,
        killer: true
    }).show();
</script>

@endif
