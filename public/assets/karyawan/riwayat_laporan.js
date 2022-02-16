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
            url : "/karyawan/riwayat-laporan-list",
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
                                <td>${el.tanggal} / ${el.hari} </td>
                                <td>${el.rincian_kegiatan}</td>
                                <td>${el.hasil}</td>
                                <td><a href="/Laporan/${el.file_laporan}"><i class="fas fa-file"></i> File</a></td>
                                <td><div class="btn btn-sm btn-${(el.status_laporan == `Proses` ? `warning` : (el.status_laporan == `Ditolak` ? `danger` : `success`))}">${el.status_laporan}</div></td>
                                <td>${el.namal ?? `-`}</td>
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
        if(awal == ''){
            alert("Tanggal Tidak Boleh Kosong")
            return false
        }
        if(akhir == ''){
            alert("Tanggal Tidak Boleh Kosong")
            return false
        }

        window.open(`/karyawan/riwayat-laporan-print?awal=${awal}&akhir=${akhir}`, `_blank`)

    })

})