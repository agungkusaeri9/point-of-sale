@if (session('success'))
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script>
    toastr.success('{{ session('success') }}')
</script>
@endif
@if (session('failed'))
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script>
    toastr.error('{{ session('failed') }}')
</script>
@endif