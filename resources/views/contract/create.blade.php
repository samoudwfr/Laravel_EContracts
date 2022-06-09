@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Contract') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('contract.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row my-2">
                            <label for="ref" class="col-sm-4 col-form-label">Law</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ref" name="ref" value= "{{ $reference }}">
                                @error('ref')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="file" class="col-sm-4 col-form-label">Select Contract File</label>
                            <div class="col-sm-8">
                                <input type="file" name="file" id="file" class="form-control" accept=".pdf">

                                {{-- <input type="file" class="custom-file-input mx-5" id="contractFile" name="contractFile" accept=".pdf"> --}}
                                @error('file')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="receiver" class="col-sm-4 col-form-label">Receiver Id card</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="receiver" name="receiver" placeholder="receiver">
                                @error('receiver')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="lawyer" class="col-sm-4 col-form-label">Lawyer number</label>
                            <div class="col-sm-8">
                                <select id="lawyer" name="lawyer" class="form-select" aria-label="Default select lawyer">
                                    <option selected>Select lawyer</option>
                                    @foreach ($lawyers as $lawyer)
                                        <option value="{{ $lawyer->id }}">{{ $lawyer->name .'  ['.$lawyer->law_number .']' }}</option>
                                    @endforeach
                                </select>
                                 @error('lawyer')
                                    <span class="alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        

                        <div class="row my-3">
                            <div class="col-md-6 offset-md-10">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>

                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection