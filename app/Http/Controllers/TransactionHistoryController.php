<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionHistoryCollection;
use App\QueryBuilders\TransactionHistoryBuilder;

class TransactionHistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionHistoryBuilder $query): TransactionHistoryCollection
    {
        return (new TransactionHistoryCollection($query->paginate()))
            ->additional(
                [
                    'status' => 200,
                    'message' => 'Data Has been successfully retrieved',
                ]
            );
    }
}
