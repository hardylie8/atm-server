<?php

namespace App\Http\Controllers;

use App\Http\Requests\transferRequest;
use App\Http\Resources\userResource;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class transferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(transferRequest $request)
    {
        $user = Auth::user();
        $user->fill(['saldo' => $request->currentSaldo - $request->transferValue])->save();
        $transferRecipient = User::find($request->recipientId);
        $transferRecipient = $transferRecipient->fill(
            ['saldo' => $transferRecipient->saldo + $request->transferValue]
        )->save();
        TransactionHistory::insert([
            //sender
            [
                'user_id' => $user->id,
                'value' => $request->transferValue,
                'transaction_type' => TransactionHistory::TYPE_CREDIT,
            ],
            //receiver
            [
                'user_id' => $request->recipientId,
                'value' => $request->transferValue,
                'transaction_type' => TransactionHistory::TYPE_DEBIT,
            ],
        ]);
        return (new userResource($user))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'withdrawal Success',
                ]
            );
    }
}
