<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    public function __construct(protected Transaction $transaction)
    {
        parent::__construct($this->transaction);
    }
}
