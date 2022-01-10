$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){

    DATA()

    $(".tambah-jabatan").click(function() {
        $("#modal-form-jabatan").modal("show")
    })

    $(document).on("click",".edit",function () {
        $("#modal-form-jabatan").modal("show")
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/jabatan/${id}/edit`,
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
                }
            }
        })
    })

    $(document).on("click",".hapus", function () {
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/jabatan/${id}`,
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

    $("#form-input-jabatan").submit(function () {
        $(".text-danger").remove()
        let id = $("#id_jabatan").val()
        if(id != ''){
            type = "POST";
            url  = `/admin/jabatan/${id}/${patch}`
        }else{            
            type = "POST";
            url  = `/admin/jabatan`
        }

        data = []
        let proses = {
            url : url,
            type :type,
            error : function(xhr){
                ERROR_ALERT(xhr)
            },
            success : function(data){
                let res = data.response
                if(res.success == 1){
                    message(res)
                    DATA()
                    $("#modal-form-jabatan").modal("hide")
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })


    function DATA () {
        $("#jabatantable").DataTable({ 
            "processing" : true,
            "serverSide" : true,
            "bDestroy" : true,
            "searching" : true,
            "autoWidth" : false,
            "iDisplayLength" : 10,
            "ajax" : function (data,callback, settings) {
                $.ajax({
                    url : "/admin/jabatan",
                    type : "GET",
                    data : data,
                    error : function(xhr) {
                        ERROR_ALERT(xhr)   
                        callback({
                            draw: 1,
                            data: [],
                            recordsTotal: 0,
                            recordsFiltered: 0
                        });                     
                    },
                    success : function (data) { 
                        let res = data.response
                        if(res.success == 1){
                            callback(res.data)
                        }
                    }
                })
            }
        })
    }

})