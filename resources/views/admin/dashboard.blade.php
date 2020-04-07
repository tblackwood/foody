@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

@endpush

@section('content')

    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">room_service</i>
                                </div>
                                <p class="card-category">New Reservations</p>
                                <h3 class="card-title">{{$reservations->count()}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">date_range</i> Last 24 Hours
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">content_copy</i>
                                </div>
                                <p class="card-category">Categories / menu items</p>
                                <h3 class="card-title">{{$categoryCount}} / {{ $menuCount }}

                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons text-danger">warning</i>
                                    <a href="javascript:;">Get More Space...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">slideshow</i>
                                </div>
                                <p class="card-category">Sliders</p>
                                <h3 class="card-title">{{$sliderCount}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">local_offer</i> Tracked from Github
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-twitter"></i>
                                </div>
                                <p class="card-category">Emails</p>
                                <h3 class="card-title">+{{$emails}}</h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">update</i> Just Updated
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.partials.msg')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title ">Reservations</h4>
                            </div>
                            <div class="card-body">
                                <div class="card-content table-responsive" id="slider_tab">
                                    <table id="table" class="table"  cellspacing="0" width="100%">
                                        <thead class="text-primary">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>People</th>
                                        <th>Time and Date</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                        </thead>
                                        <tbody>
                                        @foreach($reservations as $key=>$reservation)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $reservation->name }}</td>
                                                <td>{{ $reservation->phone }}</td>
                                                <td>{{ $reservation->email }}</td>
                                                <td>{{ $reservation->people }}</td>
                                                <td>{{ $reservation->date_and_time }}</td>
                                                <th>{{ $reservation->message }}</th>
                                                <th>
                                                    @if($reservation->status == true)
                                                        <span class="label label-info">Confirmed</span>
                                                    @else
                                                        <span class="label label-danger">not Confirmed yet</span>
                                                    @endif

                                                </th>
                                                <td>{{ $reservation->created_at }}</td>
                                                <td>
                                                    @if($reservation->status == false)
                                                        <form id="status-form-{{ $reservation->id }}" action="{{ route('admin-reservation.status',$reservation->id) }}" style="display: none;" method="POST">
                                                            @csrf
                                                        </form>
                                                        <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')){
                                                            event.preventDefault();
                                                            document.getElementById('status-form-{{ $reservation->id }}').submit();
                                                            }else {
                                                            event.preventDefault();
                                                            }"><i class="material-icons">done</i></button>
                                                    @endif
                                                    <form id="delete-form-{{ $reservation->id }}" action="{{ route('admin-reservation.destroy',$reservation->id) }}" style="display: none;" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $reservation->id }}').submit();
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
