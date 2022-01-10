$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){

    DATA()

    $(".tambah-unitkerja").click(function() {
        $("#modal-form-unitkerja").modal("show")
    })

    $(document).on("click",".edit",function () {
        $("#modal-form-unitkerja").modal("show")
        let id = $(this).data("id")
        $.ajax({
            url : `/admin/unitkerja/${id}/edit`,
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
            url : `/admin/unitkerja/${id}`,
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

    $("#form-input-unitkerja").submit(function () {
        $(".text-danger").remove()
        let id = $("#id_unitkerja").val()
        if(id != ''){
            type = "POST";
            url  = `/admin/unitkerja/${id}${patch}`
        }else{            
            type = "POST";
            url  = `/admin/unitkerja`
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
                    $("#modal-form-unitkerja").modal("hide")
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })


    function DATA () {
        $("#unitkerjatable").DataTable({ 
            "processing" : true,
            "serverSide" : true,
            "bDestroy" : true,
            "searching" : true,
            "autoWidth" : false,
            "iDisplayLength" : 10,
            "ajax" : function (data,callback, settings) {
                $.ajax({
                    url : "/admin/unitkerja",
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