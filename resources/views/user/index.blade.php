@extends('layouts.app')

@section('template_title')
    User
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
                                        <th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->role }}</td>
                                      
       
                                                <td> 
                                              <form id="toggle-form-{{ $user->id }}" action="{{ route('user.update_status', $user) }}" method="POST">
                                        
                                            @csrf
                                         @method('PATCH')
                                             <button type="button" class="btn btn-sm {{ $user->enabled ? 'btn-warning' : 'btn-success' }}" onclick="toggleSaleStatus('{{ $user->id }}', {{ $user->enabled ? 0 : 1 }})">
                                            <i class="fa fa-fw {{ $user->enabled ? 'fa-times' : 'fa-check' }}"></i> {{ $user->enabled ? 'Inhabilitar' : 'Habilitar' }}
                                            </button>
                                             <input type="hidden" name="status" value="{{ $user->enabled ? 0 : 1 }}">
                                               </form>
                                               </td>

                                        
                                            <td>
                                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                                    @if($user->enabled)
                                                        
                                                        <a class="btn btn-sm btn-success" href="{{ route('user.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-success disabled" disabled><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</button>
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
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function toggleSaleStatus(userId, status) {
    var form = document.getElementById('toggle-form-' + userId);
    var action = status ? 'habilitar' : 'inhabilitar';

    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción cambiará el estado del Usuario a ' + (status ? 'habilitado' : 'inhabilitado') + '.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, ' + action,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

</script>
