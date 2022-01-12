$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// kegunaan patch untuk update data keselurahan
var patch = "?_method=PATCH";

// error validation / alert
function ERROR_ALERT($xhr) {
    if ($xhr.status == 404) {
        alert('Halaman Tidak Ada atau NOT FOUND 404');
    } else if ($xhr.status == 403) {
        alert('Tidak Akses (Forbidden) 403');
    } else if ($xhr.status == 500) {
        alert('Internal Server Error [500]');
    } else if ($xhr.status == 422) {
        $.each($xhr.responseJSON.errors, function (key, val) {
            $("#" + key).closest('div').append("<span class='text-danger' >" + val + "</span>");
        });
    }
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

// pesan response ketika selesai data berhasil
function message(respons) {
    $("div.psuccess").text(respons.message).fadeIn(300).delay(2000).fadeOut(400);
}


function myswalconfirm(text = 'Konfirmasi', btn = 'Ya, lanjutkan') {
    return swal({
        buttons: {
          confirm: {
            text: "Ya",
            value: "yes",
            visible   : true,
          },
          cancel: {
              text: "Tidak",
              value: "no",
              visible   : true,
          },
        },            
        title   : "Apakah Anda Yakin ?",
        text    : text,
        icon    : "warning",
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
      });
}

function swalcancel(title = 'Menunggu 3 Detik...', text = 'Harap tunggu...')
{
    return  swal({
        title: title,
        icon : "/load.gif",
        text :text,
        timer: 3000,
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    });
}

function myswalloading(title = 'Loading', text = 'Harap tunggu...') {
    return swal({
        title: title,
        text: text,
        buttons: false,
        closeOnClickOutside: false,
        closeOnEsc: false
    })
}
