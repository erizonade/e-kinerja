<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

{{-- env('APP_NAME')config('app.name') --}}
<title>{{ config('app.name') }} | {{ !empty($nama)  && $nama ? $nama : '' }} </title>
<!-- Font Awesome Icons -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-12/css/all.css"> --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.css')}}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
<!-- Datatable Button -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> --}}
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">								
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">			
<!-- DateTimePicker -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.css') }}">
<!-- custom css -->
<link rel="stylesheet" href="{{ asset('assets/admin_pusat/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin_pusat/css/switchbutton.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin_pusat/css/switchkonsumen.css') }}">
<!-- kalender -->
<link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" /> --}}
<link rel="stylesheet" href="{{ asset('assets/plugins/dtp/bootstrap-datepicker.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/dtp/buttons.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/clockpicker/bootstrap-clockpicker.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 400px;
      width: 100%;
      position: unset;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    #description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.alert-box {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.psuccess {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
    display: none;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
  
}
.pac-container {
    z-index: 999999999999;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}

#target {
  width: 345px;
}


#loadingProduk{	
    position: fixed;
    top: 0;
    z-index: 100;
    width: 100%;
    height:100%;
    display: none;
    background: rgba(0,0,0,0.6);
  }
  .cv-spinner {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;  
  }
  .spinner {
    width: 40px;
    height: 40px;
    border: 4px #ddd solid;
    border-top: 4px #2e93e6 solid;
    border-radius: 50%;
    animation: sp-anime 0.8s infinite linear;
  }
  @keyframes sp-anime {
    100% { 
      transform: rotate(360deg); 
    }
  }
  .is-hide{
    display:none;
  }
</style>