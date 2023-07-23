<?php

namespace App\Services\Ipg;

use App\Core\PayStar\Facade\Paystar;
use App\Exceptions\TransactionException;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Traits\Exceptionable;
use Exception;
use Illuminate\Support\Str;

class PaymentService
{
    use Exceptionable;

    public function __construct(public UserRepositoryInterface $userRepository,
                                public TransactionRepositoryInterface $transactionRepository)
    {
    }

    public function createTransaction(array $data): array
    {
        try {
            $orderId = Str::random();
            $user = $this->userRepository->findBy('id', auth()->id());
            $response = Paystar::createTransaction($data['amount'], $orderId, $user['username']);
            if ($response['status'] != 200) {
                return ['status' => $response['status'], 'message' => $response['body']['message']];
            }
            $body = $response['body'];
            $transaction = $this->transactionRepository->create([
                'amount' => $data['amount'],
                'ref_number' => $body['data']['ref_num'],
                'order_id' => $orderId,
                'user_id' => $user['id']
            ]);
            if (!$transaction) {
                throw new TransactionException();
            }
            $body['data']['redirect_url'] = config('paystar.base_url') . '/payment?token=' . $body['data']['token'];
            return ['status' => 200, 'message' => $response['body']['message'], 'data' => $body['data']];
        } catch (Exception $exception) {
            return $this->getException($exception);
        }
    }
}
