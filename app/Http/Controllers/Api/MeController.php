<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'data' => Auth::guard('api')->user(),
        ]);
    }
}
