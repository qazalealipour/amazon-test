<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toastr-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.error("{{ session('toastr-error') }}");
    });
</script>
