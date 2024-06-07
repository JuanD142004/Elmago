@extends('layouts.app')

@section('template_title')
    Tipo de Camión
@endsection


@section('content')
<br>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- DataTable de reportes -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<body>
    <style>
        body{
        background-image: url('/img/El_mago.jpg');
        background-size: cover; /* Ajusta la imagen para que cubra todo el fondo */
        background-position: center; /* Centra la imagen */
        background-repeat: no-repeat; /* Evita que la imagen se repita */
        background-attachment: fixed;
        height: 100vh; /* Ajusta la altura al 100% de la ventana */
        width: 100vw; /* Ajusta el ancho al 100% de la ventana */
        
        overflow-x: hidden; /* Evita el desbordamiento horizontal */
        }


        .card {
                background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco con 80% de opacidad */
                border: none; /* Sin bordes para la tarjeta */
            }

            .table {
                background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
            }
        .dt-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            color: white !important; /* Ensure the text color is white */
        }
    
    </style>
    <style>
        /* Estilos personalizados para los botones de exportación */
        .dt-buttons .btn {
            font-size: 14px; /* Aumenta el tamaño de la fuente */
            padding: 8px 29px; /* Aumenta el rellenado (padding) */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        .dt-buttons .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }
        
        .dt-buttons .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        
        .dt-buttons .btn-info {
            background-color: #17a2b8;
            color: #fff;
            border: none;
        }
        
        .dt-buttons .btn:hover {
            opacity: 0.8;
        }
        
        .dt-buttons .btn:focus {
            outline: none;
            box-shadow: none;
        }
        
        /* Estilos adicionales para ajustar el espaciado y la alineación */
        .dataTables_wrapper .dt-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }
        .dataTables_wrapper .dt-buttons .btn {
            background-color: #1e3a5e !important;
            border-color: #1e3a5e !important;
            color: white !important;
        }
        
        .dataTables_wrapper .dt-buttons .btn:hover {
            background-color: #143755 !important;
            border-color: #143755 !important;
        }
        
        .dataTables_wrapper .dt-buttons .btn i {
            margin-right: 5px;
        }
        </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Tipo de Camión') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('truck_type.create') }}" class="btn btn-dark text-white btn-sm float-right" data-placement="left">
                                <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
                            </a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif
           
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="myTable" style="width:100%">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Tipo de Camión</th>
                                    <th>Placa</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                    <th class="no-print">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($truckTypes as $truckType)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $truckType->truck_brand }}</td>
                                            <td>{{ $truckType->plate }}</td>
                                            <td>{{ $truckType->ability }}</td>
                                            <td>
                                                <form id="toggle-form-{{ $truckType->id }}" action="{{ route('truck_type.update_status', $truckType) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn btn-sm {{ $truckType->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus({{ $truckType->id }}, {{ $truckType->enabled ? 0 : 1 }})">
                                                        <i class="fa fa-fw {{ $truckType->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $truckType->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                                    </button>
                                                    <input type="hidden" name="status" value="{{ $truckType->enabled ? 0 : 1 }}">
                                                </form>
                                            </td>
                                            <td class="no-print">
                                                <form action="{{ route('truck_type.destroy', $truckType->id) }}" method="POST">
                                                    @if($truckType->enabled)
                                                        <a class="btn btn-sm btn-success" href="{{ route('truck_type.edit', $truckType->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled" disabled>
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                        </button>
                                                    @endif
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- script de reportes -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" defer></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js" defer></script>
<script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        titleAttr: 'Exportar a Excel',
                        title: 'Distribuciones El Mago Tipo de Camion',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i>',
                        titleAttr: 'Exportar a PDF',
                        title: 'Distribuciones El Mago Tipo de Camion',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir',
                        title:'Distribuciones El Mago Tipo de Camion',
                        className: 'btn btn-info',
                        exportOptions: {
                            columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                        }
                    }
                    
                ]
            });
        });
        

    function toggleSaleStatus(truckTypeId, status) {
        var form = document.getElementById('toggle-form-' + truckTypeId);
        var action = status ? 'habilitar' : 'inhabilitar';

        Swal.fire({
            title: '¿Estás seguro?',
            text: `Esta acción cambiará el estado del Camión a ${status ? 'habilitado' : 'inhabilitado'}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Sí, ${action}`,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection
