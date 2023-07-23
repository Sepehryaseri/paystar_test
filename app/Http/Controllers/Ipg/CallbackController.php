<?php

namespace App\Http\Controllers\Ipg;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CallbackRequest;
use App\Services\Ipg\CallbackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function __construct(public CallbackService $callbackService)
    {
    }

    public function callback(CallbackRequest $request): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = $request->validated();
        $result = $this->callbackService->callback($data);
        if ($result['status'] != 200) {
            return view('payment', ['message' => $result['message']]);
        }
        return view('payment', $result['data']);
    }
}
