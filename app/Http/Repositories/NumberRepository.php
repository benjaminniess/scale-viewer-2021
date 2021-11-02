<?php namespace App\Http\Repositories;

use App\Contracts\NumberRepositoryInterface;
use App\Models\Board;
use App\Models\Number;
use Illuminate\Support\Collection;

class NumberRepository implements NumberRepositoryInterface
{
    public function all(): Collection
    {
        return Number::get();
    }

    public function findByID(int $numberId): Number
    {
        return Number::find($numberId);
    }

    public function deleteById(int $numberId): void
    {
        Number::find($numberId)->delete();
    }

    public function store(Board $board, array $numberProperties): Number
    {
        $number = new Number();

        $number->value = $numberProperties['value'];
        $number->description = $numberProperties['description'];

        $board->numbers()->save($number);
        $board->refresh();

        return $number;
    }

    public function update(int $numberId, array $numberProperties): Board
    {
        $number = self::findByID($numberId);

        foreach ($numberProperties as $propertyKey => $value) {
            $number->$propertyKey = $value;
        }

        $number->save();
        $number->refresh();

        $number->board->numbers()->save($number);
        $number->board->refresh();

        return $number->board;
    }
}
