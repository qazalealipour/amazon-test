<script>
    $(document).ready(function() {
        Swal.fire({
            icon: 'success',
            title: '{{ session('swal-success') }}',
            showConfirmButton: true,
            confirmButtonText: 'باشه',
            confirmButtonColor: '#50cd89'
        });
    });
</script>
