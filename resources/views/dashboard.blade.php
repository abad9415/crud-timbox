@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('activeAdministrationEmployees') active @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">{{ strtoupper(__('employees.employees')) }}</div>
                    <div class="card-body">
                        <table class="table table-bordered" id="employees-table">
                            <thead>
                            <tr>
                                <th>Clave empleado</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Puesto</th>
                                <th>Direccion</th>
                                <th>Habilidades</th>
                                <th>Acción</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
//TODO - Download all the resources and added by Webpack
        $(document).ready(function() {
            $('#employees-table').DataTable({
                lengthMenu: [ 5, 10, 25, 50, 100 ],
                "language": {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "No se encontraron resultados",
                    "sEmptyTable":    "Ningún dato disponible en esta tabla",
                    "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Buscar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                serverSide: true,
                ajax: '{{ url('api/get-employees') }}',
                columns: [
                    { data: 'employeeKey'},
                    { data: 'name'},
                    { data: 'age'},
                    { data: 'position'},
                    { data: 'address'},
                    { data: 'skills'},
                    { data: 'action'}
                ],
            });
        } );

        function deleteEmployee(id) {
            //TODO - this method is vulnerable
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url: '{{ url('api/delete-employee') }}',
                data: 'id=' + id,
                success:function(){
                    location.reload();
                }
            });
        }

    </script>
@endsection
