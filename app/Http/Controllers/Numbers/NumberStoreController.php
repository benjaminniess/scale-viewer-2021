<?php

namespace App\Http\Controllers\Numbers;

use App\Contracts\NumberRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\NumberStoreRequest;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Response;

class NumberStoreController extends Controller
{
    private NumberRepositoryInterface $numberRepository;

    public function __construct(NumberRepositoryInterface $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function store(Board $board, NumberStoreRequest $request): Response
    {
        if ($request->user()->cannot('update', $board)) {
            abort(403);
        }

        $this->numberRepository->store($board, [
            'value' => $request->value,
            'description' => $request->description,
        ]);

        return response($board, 201);
    }
}
