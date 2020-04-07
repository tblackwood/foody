@extends('layouts.app')

@section('title', 'Menu')

@push('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('menu-items.create') }}" class="btn btn-primary">Add New</a>
                    @include('admin.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Menu</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-content table-responsive" id="slider_tab">
                                <table id="table" class="table"  cellspacing="0" width="100%">
                                    <thead class="text-primary">
                                    <tr><th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr></thead>
                                    <tbody>
                                        @foreach($menus as $k=>$menu)
                                            <tr>
                                                <td>{{$k + 1}}</td>
                                                <td>{{$menu->name}}</td>
                                                <td>{{ $menu->category->name }}</td>
                                                <td>{{$menu->description }}</td>
                                                <td>{{$menu->price }}</td>
                                                <td>
                                                    <a href="{{ route('menu-items.edit',$menu->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                                                    <form id="delete-form-{{ $menu->id }}" action="{{ route('menu-items.destroy',$menu->id) }}" style="display: none;" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $menu->id }}').submit();
                                                        }else {
                                                        event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
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
    </div>

@endsection


@push('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
