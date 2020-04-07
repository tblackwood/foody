@extends('layouts.app')

@section('title','Email')

@push('css')

@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.partials.msg')
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">From - {{ $contact->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <strong>Name: {{ $contact->name }}</strong><br>
                                <strong>Phone: {{ $contact->phone }}</strong><br>
                                <b>Email: {{ $contact->email }}</b> <br>
                                <strong>Message: </strong><hr>

                                <p>{{ $contact->message }}</p><hr>

                            </div>
                            <a href="{{ route('admin-contact.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
