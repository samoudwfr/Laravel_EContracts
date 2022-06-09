@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>{{ __('My Produced Contracts') }}</b></div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="thead-light">
                        @if ($allContracts->isEmpty() )
                            <div class="col text-center">No contracts pending your action</div> 
                        @else
                          <tr>
                            <th scope="col">Ref</th>
                            <th scope="col">Receiver</th>
                            <th scope="col">Lawyer</th>
                            <th scope="col">Lawyer action</th>
                            <th scope="col">Receiver action</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($allContracts as $contract)
                            <tr>
                                <td scope="col"><a href="{{ route("contractDisplay",$contract->reference) }}" target="_blank">{{ $contract->reference }}</a></td>
                                <td scope="col"><a href="{{ route('civil.show', App\Models\Civil::find($contract->receiver_id))}}">{{ App\Models\Civil::find($contract->receiver_id)->name }}</a></td>
                                <td scope="col">{{ App\Models\Civil::where('id',$contract->lawyer_id)->first()->name. ' ['.
                                                    App\Models\Civil::where('id',$contract->lawyer_id)->first()->law_number .']' }}</td>
                                <td scope="col">
                                    <span class="@if($contract->statusLawyer_id == 1){
                                        bg-warning
                                        } @elseif($contract->statusLawyer_id == 2){
                                            bg-danger
                                        }@elseif($contract->statusLawyer_id == 3){
                                            bg-success
                                        }@endif">{{ App\Models\Status::where('id',$contract->statusLawyer_id)->first()->status}}
                                    </span>
                                </td>
                                <td>
                                    <span class="@if($contract->statusReceiver_id == 1){
                                        bg-warning
                                        } @elseif($contract->statusReceiver_id == 2){
                                            bg-danger
                                        }@elseif($contract->statusReceiver_id == 3){
                                            bg-success
                                        }@endif">{{ App\Models\Status::where('id',$contract->statusReceiver_id)->first()->status}}
                                    </span>
                                </td>
                                <td scope="col">
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteContractModal{{ $contract->id }}">
                                        Delete
                                      </button>
                                </td>
                            </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteContractModal{{ $contract->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Contract</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        Contract ref: <b> {{ $contract->reference }} </b> will be deleted, Please Confirm.
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                                        <form action="{{ route('contract.destroy', $contract->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary btn-sm" type="submit">Delete</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



