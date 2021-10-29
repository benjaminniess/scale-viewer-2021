<?php namespace App\Http\Repositories;


use App\Contracts\BoardRepositoryInterface;
use App\Models\Board;
use Illuminate\Support\Collection;

class BoardRepository implements BoardRepositoryInterface
{

    public function all(): Collection
    {
        return Board::without('numbers')->get();
    }

    public function findByID(int $boardId): Board
    {
        return Board::find($boardId);
    }

    public function deleteById(int $boardId): void
    {
        Board::find($boardId)->delete();
    }

    public function store(array $boardProperties): Board
    {
        $board = new Board();

        foreach ($boardProperties as $propertyKey => $value) {
            $board->$propertyKey = $value;
        }

        $board->save();

        return $board;
    }
}
