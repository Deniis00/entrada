@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/entradas.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-sm-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center">Entradas</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="listado-custom" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nro. Entrada</th>
                                        <th>Responsable</th>
                                        {{-- <th>Asistió</th> --}}
                                        {{-- <th>Pagado</th> --}}
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($entradas as $entrada)
                                        <tr class="{{ $entrada->estado_pago == true ? 'verde-row' : 'rojo-row' }}">
                                            <td>{{ $entrada->nro_entrada }}</td>
                                            <td>{{ $entrada->responsable }} </td>
                                     
                                            <td class="text-center">
                                                <div class="btn-group text-center">
                                                    @if ($entrada->asistio == false)
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-info btn-outline btn-circle btn-xs marcar-asistencia"
                                                            data-id="{{ $entrada->id }}"
                                                            data-url="{{ route('registro_asistencia') }}"
                                                            data-nro_entrada="{{ $entrada->nro_entrada }}"
                                                            data-toggle="tooltip" title="Marcar Asistencia">
                                                            <i class="fa fa-user-check ambitious-padding-btn"></i>
                                                        </a> &nbsp;&nbsp;
                                                    @endif
                                                    @if ($entrada->estado_pago == false)
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-info btn-outline btn-circle btn-xs registrar-cobro"
                                                            data-id="{{ $entrada->id }}"
                                                            data-url="{{ route('registro_cobro') }}"
                                                            data-nro_entrada="{{ $entrada->nro_entrada }}"
                                                            data-toggle="tooltip" title="Registrar Cobro">
                                                            <i class="fa fa-cash-register ambitious-padding-btn"></i>
                                                        </a> &nbsp;&nbsp;
                                                    @endif


                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            var tituloCard = $(".card-header h3").text();

            $('#listado-custom').DataTable({
                //dom: 'frtiP',
                stateSave: true,
                "initComplete": function(settings, json) {
                    $('#listado-custom').fadeIn(
                        500
                    ); // Hace que la tabla aparezca gradualmente una vez que DataTables está listo
                },
                "buttons": [],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "buttons": {
                        "copy": "Copiar",
                        "print": "Imprimir",
                        "excel": "Exportar a Excel",
                        "pdf": "Exportar a Pdf",
                        "colvis": "Columnas Visibles",
                    },
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "Print": "Imprimir",
                    "processing": "Procesando...",
                    "loadingRecords": "Cargando...",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "aria": {
                        "sortAscending": ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                    }
                },
                "lengthMenu": [10, 25, 50, 100],
                "pagingType": 'simple_numbers',
                "pageLength": 10,

            }).buttons().container().appendTo('#listado-custom_wrapper .col-md-6:eq(0)');
            // Delegación de eventos para botones dentro de DataTables
            $('#listado-custom').on('click', '.marcar-asistencia', function() {
                var id = $(this).data('id'); // Asegúrate de que cada botón tenga un atributo data-id
                var url = $(this).data('url');
                var link = $(this);
                var nro_entrada = $(this).data('nro_entrada');

                console.log(url);
                Swal.fire({
                    title: `¿Desea registrar la entrada ${nro_entrada}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, registrar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url, //'/registrar_asistencia', // Asegúrate de que esta ruta sea correcta
                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}' // Token CSRF para seguridad en Laravel
                            },
                            success: function(response) {


                                Swal.fire(
                                    'Marcado!',
                                    'La asistencia ha sido marcada.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed || result
                                        .isDismissed) {
                                        location
                                            .reload(); // Recarga la página después de cerrar el SweetAlert
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error', 'Hubo un problema: ' + xhr
                                    .responseText, 'error');
                            }
                        });
                    }
                });
            });
            $('#listado-custom').on('click', '.registrar-cobro', function() {
                var id = $(this).data('id'); // Asegúrate de que cada botón tenga un atributo data-id
                var url = $(this).data('url');
                var link = $(this);
                var nro_entrada = $(this).data('nro_entrada');

                console.log(url);
                Swal.fire({
                    title: `¿Desea registrar el cobro de la entrada ${nro_entrada}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, registrar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url, //'/registrar_asistencia', // Asegúrate de que esta ruta sea correcta
                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}' // Token CSRF para seguridad en Laravel
                            },
                            success: function(response) {


                                Swal.fire(
                                    'Registrado!',
                                    'Cobro registrado con exito!!.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed || result
                                        .isDismissed) {
                                        location
                                            .reload(); // Recarga la página después de cerrar el SweetAlert
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error', 'Hubo un problema: ' + xhr
                                    .responseText, 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
