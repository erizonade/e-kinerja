$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
    DATA()

    $(".tambah-karyawan").click(function(){
        $("#modal-form-karyawan").modal("show")
    })

    $(document).on("click",".edit",function () {
        $("#modal-form-karyawan").modal("show")
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/karyawan/${id}/edit`,
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
            url : `/admin/karyawan/${id}`,
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

    $("#form-input-karyawan").submit(function () {
        $(".text-danger").remove()
        let id = $("#id_karyawan").val()
        if (id != '') {
            url = `/admin/karyawan/${id}${patch}`
            type = "POST"
        } else {
            url = `/admin/karyawan`
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
                    $("#modal-form-karyawan").modal("hide")
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })

    function DATA(){
        $("#karyawantable").DataTable({
            "processing" : true,
            "serverSide" : true,
            "bDestroy" : true,
            "searching" : true,
            "autoWidth" : false,
            "iDisplayLength" : 10,
            "ajax" : function(data, callback, settings){
                $.ajax({
                    url: "/admin/karyawan",
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