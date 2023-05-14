<?php

namespace App\Http\Controllers;

use App\Http\Requests\withdrawalRequest;
use App\Http\Resources\userResource;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Auth;

class withdrawalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(withdrawalRequest $request)
    {
        $user = Auth::user();
        $user->fill(['saldo' => $request->currentSaldo - $request->withdrawValue])->save();
        $user->TransactionHistory()->create([
            'user_id' => $user->id,
            'value' => $request->withdrawValue,
            'transaction_type' => TransactionHistory::TYPE_CREDIT,
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
