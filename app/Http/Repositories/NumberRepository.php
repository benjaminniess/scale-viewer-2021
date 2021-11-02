<?php namespace App\Http\Repositories;

use App\Contracts\NumberRepositoryInterface;
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

    public function store(array $numberProperties): Number
    {
        $number = new Number();

        foreach ($numberProperties as $propertyKey => $value) {
            $number->$propertyKey = $value;
        }

        $number->save();

        return $number;
    }

    public function update(int $numberId, array $numberProperties): Number
    {
        $number = self::findByID($numberId);

        foreach ($numberProperties as $propertyKey => $value) {
            $number->$propertyKey = $value;
        }

        $number->save();
        $number->refresh();

        return $number;
    }
}
