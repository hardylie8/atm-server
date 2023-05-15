<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSaveRequest;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $user = Auth::user();
        return (new userResource($user))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'withdrawal Success',
                ]
            );
    }

    public function update(UserSaveRequest $request, )
    {
        $user = Auth::user();
        $user->fill($request->only($user->offsetGet('fillable')));

        if ($user->isDirty()) {
            $user->save();
        }

        return (new userResource($user))
            ->additional([
                'status' => 200,
                'message' => 'Success',
            ]);
    }
}
