<script>
    $(document).ready(function() {
        var element = $('.delete');
        element.on('click', function(e) {
            e.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'آیا از حذف کردن داده مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'بله حذف شود',
                cancelButtonText: 'انصراف',
                reverseButtons: true
            }).then((result) => {
                if (result.value == true) {
                    $(this).parent().submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    return true;
                }
            });
        });
    });
</script>
