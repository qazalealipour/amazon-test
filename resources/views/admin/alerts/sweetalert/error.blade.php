<script>
    $(document).ready(function() {
        Swal.fire({
            icon: 'error',
            title: '{{ session('swal-error') }}',
            showConfirmButton: true,
            confirmButtonText: 'باشه',
            confirmButtonColor: '#f1416c'
        });
    });
</script>
