<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('admin-assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('admin-assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page custom Javascript(used by this page)-->
<script src="{{ asset('admin-assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('admin-assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Page custom Javascript-->
<script>
    let notificationDropdown = document.getElementById('notification');
    notificationDropdown.addEventListener('click', function(){
        console.log('yes');

        $.ajax({
            type : "POST",
            url : '/admin/notification/read-all',
            data : {_token: "{{ csrf_token() }}" },
            success : function(){
                console.log('yes');
            }
        })
    });
</script>