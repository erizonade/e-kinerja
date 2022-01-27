$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {
    $('#resetPassword').on('submit', function(e) {
        $(".text-danger").remove()
        e.preventDefault()
        let data = $(this).serialize()
        let type = $("#type").val()
        if (type == 'user') {
            url  = '/admin/update-password';
        } else {
            url  = '/karyawan/update-password';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(data) {
                let res = data.response
                if (res.error == 401) {
                    message(res)
                } else if (res.success == 1) {
                    message(res);
                }
            },
            error: function(xhr) {
                ERROR_ALERT(xhr)
            },
        })
    })
})