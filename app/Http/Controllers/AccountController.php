<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Transaction;
use App\Http\Response\StatusCodes;
use App\Services\Payment\IPayment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Account\AccountTransferRequest;
use App\Http\Requests\Account\StoreAccountDetailsRequest;

class AccountController extends Controller
{
    private $payment;
    private $response;

    public function __construct()
    {
        $this->payment = app(IPayment::class);
        $this->response = app(IResponse::class);
    }

    public function transfer(AccountTransferRequest $request)
    {
        DB::beginTransaction();
        try {

            $source_user = User::findOrNotFound($request->source_user_id);
            $destination_user = User::findOrNotFound($request->destination_user_id);

            $track_id = 'transfer-to-deposit-' . $request->source_user_id;
            $paymentNumber = 'payment number';

            $response = $this->payment->transfer(
                $request->source_user_id,
                $request->destination_user_id,
                $track_id,
                $request->amount,
                $request->description,
                $request->reasonDescription,
                $destination_user->first_name,
                $destination_user->last_name,
                $destination_user->account->number,
                $paymentNumber,
                $source_user->account->number,
                $source_user->first_name,
                $source_user->last_name,
            );

            if ($response != 'success_status_code')
                throw new Exception('External Service Failed');

                // This Transaction store can be moved into a lisetener because 
                // it is not part of duty of this controller 
            $db_response = Transaction::store([
                'from_account' => $source_user->account->number,
                'to_account' => $destination_user->account->number,
                'amount' => $request->amount,
            ]);

            if ($this->storeTransactionIsFailed($db_response))
                throw new Exception('Save Transaction Failed');


            return $this->response->send(StatusCodes::SUCCESS, ['transfer_details' => $response->details]);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function storeAccountDetails(StoreAccountDetailsRequest $request)
    {
        $user = User::findOrNotFound($request->user_id);

        $user->storeAccount(['account_number' => $request->account_number]);
    }

    public function storeTransactionIsFailed($db_response)
    {
        return !($db_response instanceof Transaction) or  !$db_response->exists;
    }
}
