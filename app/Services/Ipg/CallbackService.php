<?php

namespace App\Services\Ipg;

use App\Core\PayStar\Facade\Paystar;
use App\Exceptions\PayStarException;
use App\Exceptions\TransactionException;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Traits\Exceptionable;
use Exception;

class CallbackService
{
    use Exceptionable;

    public function __construct(public TransactionRepositoryInterface $transactionRepository)
    {
    }

    public function callback(array $data): array
    {
        try {
            if (empty($data['card_number']) || empty($data['tracking_code'])) {
                return ['status' => 400, 'message' => __('transaction.callback_error')];
            }

            $transaction = $this->transactionRepository->findBy('ref_number', $data['ref_num']);
            if (empty($transaction)) {
                throw new PayStarException();
            }
            $transaction = last($transaction);

            if ($data['order_id'] != $transaction['order_id']) {
                throw new TransactionException(__('transaction.order_not_match'));
            }

            if ($data['status'] != 1) {
                return ['status' => 400, 'message' => __('transaction.callback_error')];
            }

            $this->transactionRepository
                ->update($transaction['id'], ['tracking_code' => $data['tracking_code']]);

            $sign = hash_hmac('sha512', $transaction['amount'] . '#' . $data['ref_num'] . '#' . $data['card_number'] . '#' . $data['tracking_code'], config('paystar.key'));

            $response = Paystar::verifyTransaction($transaction['ref_number'], $transaction['amount'], $sign);
            $body = $response['body'];

            if ($response['status'] != 200) {
                $result = ['status' => $response['status'], 'message' => $body['message']];
                $isVerified = 0;
            } else {
                $result = ['status' => 200, 'data' => $body['data']];
                $isVerified = 1;
            }

            $this->transactionRepository
                ->update($transaction['id'], ['is_verified' => $isVerified]);

            return $result;

        } catch (Exception $exception) {
            return $this->getException($exception);
        }
    }
}
