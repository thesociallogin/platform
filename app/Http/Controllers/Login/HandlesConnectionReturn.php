<?php

namespace App\Http\Controllers\Login;

use App\Models\ConnectionRequest;
use Illuminate\Http\Request;

trait HandlesConnectionReturn
{
    protected function initConnectionReturn(Request $request): ConnectionRequest
    {
        /** @var ConnectionRequest $connectionRequest */
        $connectionRequest = ConnectionRequest::create([
            'redirect_url' => $request->fullUrl(),
        ]);

        $request->session()->put('connectionrequest', $connectionRequest->getKey());

        return $connectionRequest;
    }

    protected function handleConnectionReturn(Request $request): ?string
    {
        if (! $request->session()->has('connectionrequest')) {
            return null;
        }

        /** @var ConnectionRequest $connectionRequest */
        $connectionRequest = ConnectionRequest::findOrFail(
            id: $request->session()->get('connectionrequest')
        );

        $request->session()->forget('connectionrequest');

        return $connectionRequest->redirect_url;
    }
}
