<!-- jQuery -->
<script src="{{ asset('assets\plugins\jquery\jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets\plugins\bootstrap\js\bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets\plugins\datatables\jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-responsive\js\dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-responsive\js\responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-buttons\js\dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-buttons\js\buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-fixedcolumns\css\fixedColumns.bootstrap4.min.css') }}"></script>
<script src="{{ asset('assets\plugins\jszip\jszip.min.js') }}"></script>
<script src="{{ asset('assets\plugins\pdfmake\pdfmake.min.js') }}"></script>
<script src="{{ asset('assets\plugins\pdfmake\vfs_fonts.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-buttons\js\buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-buttons\js\buttons.print.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-buttons\js\buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets\plugins\datatables-select\js\dataTables.select.min.js') }}"></script>

<script src="{{ asset('assets\plugins\datatables-searchpanes\js\dataTables.searchPanes.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets\plugins\adminlte\js\adminlte.min.js') }}"></script>
<!-- Bootstrap Datepicker Spanish Language File -->
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets\plugins\bootstrap-datepicker\bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('assets\plugins\sweetalert2\sweetalert2.all.min.js') }}"></script>

@if (session('success'))
 
    <script>
        console.log('paso por aqui');
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: "{{ Session::get('success') }}",
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
        icon: "error",
        title: "Ocurrió un error!!",
        text: "{{ Session::get('error') }}",
        });
    </script>
@endif