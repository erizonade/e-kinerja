$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () { 
    DATA()

    $(document).on("click",".diterima",function(){
        let id = $(this).data("id")
        $.ajax({
            url : "/karyawan/verif-laporan",
            type : "GET",
            data : {
                id : id,
                status_laporan : 'Diterima'
            },
            error : function (xhr) {
                ERROR_ALERT(xhr)
            },
            success : function (data) { 
                let res = data.response
                if (res.success) {
                    message(res)
                    DATA()
                }
            }
        })
    })

    $(document).on("click",".ditolak",function(){
        let id = $(this).data("id")
        $.ajax({
            url : "/karyawan/verif-laporan",
            type : "GET",
            data : {
                id : id,
                status_laporan : 'Ditolak'
            },
            error : function (xhr) {
                ERROR_ALERT(xhr)
            },
            success : function (data) { 
                let res = data.response
                if (res.success) {
                    message(res)
                    DATA()
                }
            }
        })
    })

   $("#search-laporan").change(function(){
        DATA()
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
                data.awal = $("#tgl_awal").val()
                data.akhir = $("#tgl_akhir").val()
                data.id_karyawan = $("#id_karyawan").val()
                $.ajax({
                    url : "/karyawan/laporan-harian-bawahan",
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