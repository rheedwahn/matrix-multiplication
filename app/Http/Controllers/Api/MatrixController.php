<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Matrix\MatrixMultiplicationRequest;
use App\Services\Api\Matrix\MultiplicationService;
use Illuminate\Http\JsonResponse;

class MatrixController extends Controller
{
    /**
     * MatrixController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function matrixMultiplication(MatrixMultiplicationRequest $request): JsonResponse
    {
        $result = (new MultiplicationService($request->first_matrix, $request->second_matrix))->run();

        return response()->json(['status' => 'success', 'data' => $result],200);
    }
}
