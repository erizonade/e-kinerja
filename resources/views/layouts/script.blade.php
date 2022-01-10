<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
{{-- <script src="{{ asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('assets/plugins/moment/combodate.js')}}"></script> --}}
<!-- DataTables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/dist/js/demo.js')}}"></script>
<script src="{{ asset('assets/dist/js/pages/dashboard3.js')}}"></script>
<script src="{{ asset('assets/dist/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
				
<!-- FastClick -->
{{-- <script src="{{ asset('assets/fastclick/fastclick.js')}}"></script> --}}
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>						
<!-- Jquery Form -->
<script src="{{ asset('assets/plugins/jquery-form/jquery.form.min.js') }}"></script>

<!-- Jquery Form -->
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datetime-picker/bootstrap-datetimepicker.min.js') }}"></script>	
<script src="{{ asset('common.js')}}"></script>
@switch(Session::get('id_role'))
    @case('AR')
<script src="{{ asset('assets/notifikasi.js')}}"></script>
    @break
    @default
@endswitch


