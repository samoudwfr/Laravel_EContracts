@extends('layouts.app')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>{{ __('Pending Contract  [') . $pendingContracts->count() .']'}}</b></div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            @if ($pendingContracts->isEmpty() )
                                <div class="col text-center">No contracts pending your action</div> 
                            @else
                          <tr>
                            <th scope="col">Ref</th>
                            <th scope="col">Sender</th>
                            @if ( App\Models\Customer::where('user_id', Auth::user()->id)->first()->role_id == 2)
                                <th scope="col">Receiver</th>
                            @elseif (App\Models\Customer::where('user_id', Auth::user()->id)->first()->role_id == 3)
                                <th scope="col">Lawyer</th>
                            @endif
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingContracts as $contract )
                                <tr>
                                    <td scope="col"><a href="{{ route("contractDisplay",$contract->reference) }}" target="_blank">{{ $contract->reference }}</a></td>
                                    <td scope="col"><a href="{{ route('civil.show', App\Models\Civil::find($contract->sender_id))}}">{{ App\Models\Civil::find($contract->sender_id)->name }}</a></td>
                                     @if (App\Models\Customer::where('user_id', Auth::user()->id)->first()->role_id == 2) 
                                        <td scope="col"><a href="{{ route('civil.show', App\Models\Civil::find($contract->receiver_id))}}">{{ App\Models\Civil::find($contract->receiver_id)->name }}</a></td>
                                    @elseif (App\Models\Customer::where('user_id', Auth::user()->id)->first()->role_id == 3) 
                                    <td scope="col"><a href="{{ route('civil.show', App\Models\Civil::find($contract->lawyer_id))}}">{{ App\Models\Civil::find($contract->lawyer_id)->name }}</a></td>
                                    @endif
                                    <td scope="col">
                                        <a href="{{ route('decisionContract', ['id' => $contract->id, 'decision'=> 3]) }}" class=" btn-sm btn-success" >Accept</a>
                                        <a href="{{ route('decisionContract', ['id' => $contract->id, 'decision'=> 2]) }}" class=" btn-sm btn-danger" >Reject</a>
                                    </td>
                                </tr>
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