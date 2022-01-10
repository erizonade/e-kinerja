$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){

    DATA()

    $(".tambah-laporan").click(function () {
        $("#modal-form-laporan").modal("show")
    })

    $(document).on("click",".edit",function(){
        let id = $(this).data("id")
        $.ajax({
            url : `/karyawan/laporan-harian/${id}/edit`,
            type : "GET",
            error : function (xhr) {
                ERROR_ALERT(xhr)
            },
            success : function(data) {
                let res = data.response
                if(res.success == 1){
                    $.each(res.data,function (key,val) {
                        $(`#${key}`).val(val);                        
                    })
                    $("#modal-form-laporan").modal("show")
                }
            }
        })
    })

    $(document).on("click",".hapus",function(){
        let id = $(this).data("id")
        $.ajax({
            url : `/karyawan/laporan-harian/${id}`,
            type : "DELETE",
            error : function (xhr) {
                ERROR_ALERT(xhr)
            },
            success : function(data) {
                let res = data.response
                if(res.success == 1){
                    DATA()
                    message(res)
                }
            }
        })
    })

    $("#form-input-laporan").submit(function () {
        $(".text-danger").remove()
        let id = $("#id_laporan").val()
        if (id != '') {
            url = `/karyawan/laporan-harian/${id}${patch}`
            type = "POST"
        } else {
            url = `/karyawan/laporan-harian`
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
                    $("#modal-form-laporan").modal("hide")
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })

    function DATA(){
        $("#laporantable").DataTable({
            "processing" : true,
            "serverSide" : true,
            "bDestroy" : true,
            "searching" : true,
            "autoWidth" : false,
            "iDisplayLength" : 10,
            "order" : [[0, "desc"]],
            "ajax" : function (data,callback,settings) {
                $.ajax({
                    url : "/karyawan/laporan-harian",
                    type : "GET",
                    data : data,
                    error : function(xhr){
                        ERROR_ALERT(xhr)
                        callback({
                            draw : 1,
                            data : [],
                            recordsTotal : 0,
                            recordsFiltered : 0
                        })
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