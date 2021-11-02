<?php

namespace App\Http\Controllers\Numbers;

use App\Contracts\NumberRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\NumberUpdateRequest;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Response;

class NumberUpdateController extends Controller
{
    private NumberRepositoryInterface $numberRepository;

    public function __construct(NumberRepositoryInterface $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function update(Board $board, Number $number, NumberUpdateRequest $request): Response
    {
        if ($request->user()->cannot('update', $number)) {
            abort(403);
        }

        $updatedBoard = $this->numberRepository->update($number->id, [
            'value' => $request->value,
            'description' => $request->description,
        ]);

        return response($updatedBoard, 200);
    }
}
