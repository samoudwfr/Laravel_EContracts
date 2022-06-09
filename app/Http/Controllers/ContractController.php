<?php

namespace App\Http\Controllers;

use App\Models\Civil;
use App\Models\Contract;
use App\Rules\CheckLawyerId;
use Illuminate\Http\Request;
use App\Rules\CheckCustomerIdCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return ('hello');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lawyers = Civil::where('law_number','<>', 0)->get();
        $reference = random_int(10000, 999999);
        while(Contract::where('reference', $reference)->count()!=0){
            $reference = random_int(10000, 999999);
        }
        return view('contract.create', compact('reference', 'lawyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        

        $request->validate([
            'file' => 'required|file|mimes:pdf',
            'receiver' => ['required', new CheckCustomerIdCard()],
            'lawyer' => 'required',
        ]);

        $filename = $request->ref .'.'.$request->file->getClientOriginalExtension();
        // $request->file->move(public_path('file'), $filename);
        $request->file->move(storage_path('app\\public'), $filename);
        
        Contract::Create([
            'reference' => $request->ref,
            'document' => $filename,
            'sender_id' => Auth::user()->customer->civil->id,
            'lawyer_id' => $request->lawyer,
            'receiver_id' => Civil::where('id_number', $request->receiver)->first()->id,
            'statusLawyer_id' => 1,
            'statusReceiver_id' => 1,
        ]);

        


        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::flash('status', 'Contract '. Contract::find($id)->reference .' deleted');
        Contract::find($id)->delete();
        return redirect()->route('home');

    }

    public function pending(){

        $pendingContracts = $this->getPendingContracts()->get();
        return view('contract.pending', compact('pendingContracts'));


        

    }
    public function decisionContract($id, $decision){
        if(Auth::user()->customer->role_id == 2){   //Loged as Lawyer
            $contract = Contract::where('id', $id)->update(['statusLawyer_id'=>$decision]);;
        } 
        elseif(Auth::user()->customer->role_id == 3){   //Loged as User
            $contract = Contract::where('id', $id)->update(['statusReceiver_id'=>$decision]);;
        }
        
        return redirect()->route('home');
    }


    public function contractDisplay($ref){

        return response()->file(storage_path('app\\public\\'.$ref.'.pdf'));
    }


      
      public static function getPendingContracts(){
        $user_civilDetails = Civil::where('id', Auth::user()->customer->civil_id)->first();

        if(Auth::user()->customer->role_id == 2){   //Loged as Lawyer
            $pendingContracts = Contract::where([
                ['lawyer_id', $user_civilDetails->id],
                ['statusLawyer_id', 1]
                ]);
            }

        elseif(Auth::user()->customer->role_id == 3){   //Loged as User
            $pendingContracts = Contract::where([
                ['receiver_id', $user_civilDetails->id],
                ['statusReceiver_id', 1],
                ['statusLawyer_id', 3]
                ]);
            }

            
            return $pendingContracts;
      }
}
