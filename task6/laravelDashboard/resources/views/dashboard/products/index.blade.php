@extends('layouts.parent')
@section('title', 'Products')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    @include('includes.response-messages')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Price (EGP)</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Creation Date</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name_en }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->price }}</td>

                                @if ($product->quantity <= 0)
                                    <td class='text-danger font-weight-bold'>
                                    @elseif($product->quantity > 0 && $product->quantity <= 5)
                                    <td class='text-warning font-weight-bold'>
                                    @else
                                    <td class='text-success font-weight-bold'>
                                @endif
                                {{ $product->quantity }} </td>

                                <td>
                                    <form action="{{route('dashboard.products.toggle',$product->id)}}" method="post" class="form" >
                                        @csrf
                                        @method('PATCH')
                                        <input type="checkbox" name="my-checkbox" {{$product->status ? 'checked' : ''}} data-bootstrap-switch 
                                        data-off-color="danger" data-on-color="success" value="{{$product->status}}">
                                        
                                    </form>
                                    
                                </td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                        class="btn btn-outline-warning"> Edit </a>
                                    <form action="{{ route('dashboard.products.destroy', $product->id) }}"
                                        class="d-inline" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@endsection
@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch(
                {
                    'state': $(this).prop('checked'),
                    'onSwitchChange':function(event , status){ $(this).parents('form:first').submit(); }
                }
            );
        });
    </script>
    
@endsection
