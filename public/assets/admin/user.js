$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    DATA()

    $(".tambah-user").click(function(){
        $("#modal-form-user").modal("show")
    })

    $(document).on("click",".edit",function () {
        $("#modal-form-user").modal("show")
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/user/${id}/edit`,
            type : "GET",
            error :function(xhr){
                ERROR_ALERT(xhr)
            },
            success : function (data) { 
                let res = data.response
                if(res.success == 1){
                    $.each(res.data,function (key,val) {
                        $(`#${key}`).val(val)
                    })
                    $("#password").val("")
                }
            }
        })
    })

    $(document).on("click",".hapus", function () {
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/user/${id}`,
            type : "DELETE",
            error : function(xhr)
            {
                ERROR_ALERT(xhr)
            },
            success: function (data) {
                let res = data.response
                if(res.success == 1){
                    DATA()
                    message(res)
                }
            }
        })
    })

    $("#form-input-user").submit(function () {
        $(".text-danger").remove()
        let id = $("#id_user").val()
        if (id != '') {
            url = `/admin/user/${id}${patch}`
            type = "POST"
        } else {
            url = `/admin/user`
            type = "POST"
        }

        data = []
        let proses = {
            url : url,
            type : type,
            data : data,
            error : function(xhr){
                ERROR_ALERT(xhr)
            },
            success : function (data) {  
                let res = data.response
                if(res.success == 1){
                    message(res)
                    DATA()
                    $("#modal-form-user").modal("hide")
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })

    function DATA(){
        $("#usertable").DataTable({
            "processing" : true,
            "serverSide" : true,
            "bDestroy" : true,
            "searching" : true,
            "autoWidth" : false,
            "iDisplayLength" : 10,
            "ajax" : function(data, callback, settings){
                $.ajax({
                    url: "/admin/user",
                    type: "GET",
                    data: data,
                    error : function(xhr){
                        ERROR_ALERT(xhr)
                        callback({
                            draw : 1,
                            data : [],
                            recordsTotal : 0,
                            recordsFiltered : 0
                        })
                    },
                    success: function (data) {
                        let res = data.response
                        if(res.success == 1){
                            callback(res.data)
                        }
                    }
                });
            }
        })
    }
})