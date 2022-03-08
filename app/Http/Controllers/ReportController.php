<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Http\Response\StatusCodes;
use App\Http\Requests\Account\GetUserTransactionsRequest;

class ReportController extends Controller
{
    private $response;

    public function __construct()
    {
        $this->response = app(IResponse::class);
    }

    public function getTransactions(GetUserTransactionsRequest $request)
    {
        $user = User::findOrNotFound($request->user_id);

        $account = $user->account;

        if (!($account instanceof Account) or !$account->exists)
            return $this->response->send(StatusCodes::NOT_FOUND);


        $transactions = Transaction::getByPaymentNumber($user->account->id, $request->payment_number);

        return $this->response->send(StatusCodes::SUCCESS, ['transactions' => $transactions]);
    }
}
