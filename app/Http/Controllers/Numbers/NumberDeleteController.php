<?php

namespace App\Http\Controllers\Numbers;

use App\Contracts\NumberRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NumberDeleteController extends Controller
{
    private NumberRepositoryInterface $numberRepository;

    public function __construct(NumberRepositoryInterface $numberRepository)
    {
        $this->numberRepository = $numberRepository;
    }

    public function delete(Board $board, Number $number, Request $request): Response
    {
        if ($request->user()->cannot('delete', $number)) {
            abort(403);
        }

        $this->numberRepository->deleteById($number->id);

        return response('Number deleted', 204);
    }
}
