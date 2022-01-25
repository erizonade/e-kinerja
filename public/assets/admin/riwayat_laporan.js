$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(function () {
    
    $("#search-laporan").submit(function () {
        $(".laporan-body").empty()
        data = []
        let proses = {
            url : "/admin/riwayat-laporan-list",
            type : "POST",
            data : data,
            error : function (xhr) {
                ERROR_ALERT(xhr)
            },
            success : function (data) {
                let res = data.response
                if (res.success == 1) {
                    let no = 1;
                    res.data.forEach(el => {
                        $(`.laporan-body`).append(`
                        
                            <tr>
                                <td widtd='5%'>${no++}</td>
                                <td>${el.namak}</td>
                                <td><a class="btn btn-danger mb-2 ml-2 cetak-laporan" data-id=${el.idkaryawan} type="button"><i class="fa fa-file-pdf"></i></a></td>
                            </tr>

                        `)
                    });
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false
    })

    $(document).on("click", ".cetak-laporan", function () {
        let awal  = $("#tgl_awal").val()
        let akhir = $("#tgl_akhir").val()
        let id = $(this).data("id")
        if(awal == ''){
            alert("Tanggal Tidak Boleh Kosong")
            return false
        }
        if(akhir == ''){
            alert("Tanggal Tidak Boleh Kosong")
            return false
        }

        window.open(`/admin/riwayat-laporan-print?awal=${awal}&akhir=${akhir}&id=${id}`, `_blank`)

    })

})