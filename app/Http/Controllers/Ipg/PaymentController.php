<?php

namespace App\Http\Controllers\Ipg;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreateTransactionRequest;
use App\Services\Ipg\PaymentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class PaymentController extends Controller
{
    public function __construct(protected PaymentService $paymentService)
    {
    }

    public function createTransaction(CreateTransactionRequest $request): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $data = $request->validated();
        $result = $this->paymentService->createTransaction($data);
        if ($result['status'] != 200) {
            return redirect()->back()->withErrors(['message' => $result['message']]);
        }
        return redirect($result['data']['redirect_url']);
    }
}
