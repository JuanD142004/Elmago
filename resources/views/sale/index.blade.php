@extends('layouts.app')

@section('template_title')
Venta
@endsection

@section('content')
<br>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
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
          background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
          border: none; /* Sin bordes para la tarjeta */
      }

      .table {
          background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con 80% de opacidad */
      }
    .btn-dark-blue {
            background-color: #004085;
            border-color: #003768;
            color: #fff;
        }

        .btn-dark-blue:hover,
        .btn-dark-blue:focus,
        .btn-dark-blue:active {
            background-color: #004085;
            border-color: #003768;
            color: #fff;
            opacity: 1;
        }

        .btn-dark-blue.enabled, 
        .btn-dark-blue:enabled {
            background-color: #004085;
            border-color: #003768;
            opacity: 0.65;
        }
  </style>
  <style>
    /* Estilos personalizados para los botones de exportación */
    .dt-buttons .btn {
        font-size: 14px; /* Aumenta el tamaño de la fuente */
        padding: 9px 24px; /* Aumenta el rellenado (padding) */
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
          <div class="d-flex justify-content-between align-items-center">
            <span id="card_title">{{ __('Ventas') }}</span>
            <div class="float-right">
              <a href="{{ route('sales.create') }}" class="btn btn-dark text-white btn-sm float-right" data-placement="left">
                <i class="fas fa-plus"></i> {{ __('Crear Nuevo') }}
              </a>
            </div>
          </div>
          @if ($message = Session::get('success'))
          <div class="alert alert-success mt-3">
            <p>{{ $message }}</p>
          </div>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="salesTable" class="table table-striped table-hover dataTable">
              <thead class="thead-light">
                <tr>
                  <th>No</th>
                  <th>Cliente</th>
                  <th>Total Precio</th>
                  <th>Método de Pago</th>
                  <th>Mostrar</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sales as $sale)
                <tr>
                  <td>{{ $sale->id }}</td>
                  <td>{{ $sale->customer->id }} - {{ $sale->customer->customer_name }}</td>
                  <td>{{ $sale->price_total }}</td>
                  <td>{{ $sale->payment_method }}</td>
                  <td class="d-print-none">
                      <a class="btn btn-sm btn-dark-blue" href="{{ route('sales.show', $sale->id) }}" {{ $sale->enabled ? '' : 'disabled' }}>
                          <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                      </a>
                  </td>
                  <td>
                      @if($sale->enabled)
                          <button type="button" id="toggle-button-{{ $sale->id }}" class="btn btn-sm btn-success" onclick="toggleSaleStatus('{{ $sale->id }}', {{ $sale->enabled ? 'false' : 'true' }})">
                              <i class="fa fa-fw fa-ban"></i> {{ __('Anular') }}
                          </button>
                      @else
                          <button type="button" id="toggle-button-{{ $sale->id }}" class="btn btn-sm btn-warning" disabled>
                              <i class="fa fa-fw fa-times-circle"></i> {{ __('Anulado') }}
                          </button>
                      @endif
                      <form id="toggle-form-{{ $sale->id }}" action="{{ route('sales.toggle', $sale->id) }}" method="POST" style="display: none;">
                          @csrf
                          @method('PUT')
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
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
    $('#salesTable').DataTable({
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
                title: 'Distribuciones El Mago Proveedores',
                className: 'btn btn-success',
                exportOptions: {
                    columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar a PDF',
                title: 'Distribuciones El Mago Proveedores',
                className: 'btn btn-danger',
                exportOptions: {
                    columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                title:'Distribuciones El Mago Proveedores',
                className: 'btn btn-info',
                exportOptions: {
                    columns: ':not(:last-child)' // Esto excluye la última columna (acciones)
                }
            }
            
        ]
    });
});
   window.toggleSaleStatus = function(saleId, status) {
      var form = document.getElementById('toggle-form-' + saleId);
      var action = status ? 'Anular' : 'Anulado';

      Swal.fire({
        title: '¿Estás seguro?',
        text: `Esta acción cambiará el estado de la venta a ${status ? 'Anular' : 'Anulado'}.`,
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
    };
  

  function sortSalesTable() {
    var tbody = document.getElementById('salesTableBody');
    var rows = Array.from(tbody.getElementsByTagName('tr'));

    rows.sort((a, b) => {
      var aStatus = parseInt(a.cells[5].innerText);
      var bStatus = parseInt(b.cells[5].innerText);
      return bStatus - aStatus;
    });

    rows.forEach(row => tbody.appendChild(row));
  }
</script>

@endsection
