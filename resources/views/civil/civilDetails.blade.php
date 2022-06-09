@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Customer Details') }}</b>
                </div>
                    
                <div class="card-body">
                    <div class="row">
                        <span class="col-4">Nom:</span>
                        <span class="col-8">{{ $civil->name }}</span>
                    </div>
                    <div class="row">
                        <span class="col-4">Date of Birth:</span>
                        <span class="col-8">{{ $civil->birth_date }}</span>
                    </div>
                    <div class="row">
                        <span class="col-4">ID Card:</span>
                        <span class="col-8">{{ $civil->Id_number }}</span>
                    </div>
                    <div class="row">
                        <span class="col-4">Address:</span>
                        <span class="col-8">{{ $civil->address }}</span>
                    </div>
                    <div class="row">
                        <span class="col-4">Law Number:</span>
                        <span class="col-8">{{ $civil->law_number }}</span>
                    </div>
                    <div class="row">
                        <span class="col-4">Profession:</span>
                        <span class="col-8">{{ $civil->profession }}</span>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ URL::previous() }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



