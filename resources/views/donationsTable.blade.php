@extends('layouts.app')

@section('content')
    <div class="container-fluid w-50">
        <div class="card">
            <div class="card-header">Donations Table</div>

            <div class="card-body">
                <donations-component></donations-component>
            </div>
        </div>
    </div>
@endsection