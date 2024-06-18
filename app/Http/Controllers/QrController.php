<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Qr;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QrController extends Controller
{
    public function generateQR(Request $request){
        $validator = Validator::make($request->all(),[
            'account' => 'required|integer|exists:accounts,id',
            'quantity' => 'required|integer',
            'valide' => 'integer'
        ]);

        if($validator->fails()) return response(['message' => 'Error'],400);
        $qr=new Qr();
        $qr->account_id=$request->account;
        $qr->quantity=$request->quantity;
        if($request->hasAny('valide')) $qr->valide=$request->valide;
        $qr->save();
        $obj=[
            'id' => $qr->id,
            'account' => $qr->account_id,
            'quantity' => $qr->quantity
        ];
        return Response()->json($obj,200);
    }

    public function statusQR(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer|exists:qrs,id'
        ]);
        if($validator->fails()) return response(['message' => 'Error'],400);
        $qr = QR::find($request->id);
        switch ($qr->status) {
        case null:
            return response()->json(['message'=>'qr actived'],200);
            break;
        case 1:
            return response()->json(['message'=>'qr disabled'],200);
            break;
        }
    }

    public function scanQr(Request $request){
        // return $request;
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
            'account' => 'required|integer|exists:accounts,id',
            'quantity' => 'required|integer'
        ]);
        $validator->validate();
        // if($validator->fails()) return response(['message' => 'Error'],400);
        $qr = Qr::find($request->id);
        if($qr!=null){
            $transaction = new Transaction([
                'by' => $request->user()->account->id,
                'for' => $qr->account_id,
                'quantity' => $qr->quantity
            ]);
            if($transaction->save()){
                $account = $request->user()->account;
                $account->balance-=$qr->quantity;
                $account->save();

                $forAccount = Account::find($qr->account_id);
                $forAccount->balance+=$qr->quantity;
                $forAccount->save();
                $qr->transaction_id=$transaction->id;
                $qr->status=1;
                $qr->save();
                return view('paymentStatus',['result'=>'Pago Exitoso','color'=>'bg-success']);
            }else{
                return view('paymentStatus',['result'=>'no se pudo completar el pago','color'=>'bg-danger']);
            }
        }
        return view('paymentStatus',['result'=>'no se pudo completar el pago','color'=>'bg-danger']);
    }
}
