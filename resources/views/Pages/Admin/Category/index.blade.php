@extends('Layouts.Admin.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables online shop</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @isset($category)
                            {{$category->links()}}
                                @foreach ($category as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td><img width="200px" src="{{env('APP_URL')."/source/image/product/".$product->image}}"/></td>
                                    <th><a href="#">xoa</a>||<a href="#">sua</a></th>
                                </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css-table')
    <link href="{{ env('APP_URL') }}/adminStyle/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('js-table')
    <!-- Page level plugins -->
    <script src="adminStyle/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="adminStyle/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="adminStyle/js/demo/datatables-demo.js"></script>
@endsection
