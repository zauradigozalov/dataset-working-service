<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class AgeRangeFilter implements Filter
{
    public function __invoke(Builder $query,  $value, string $property): void
    {

        if (is_array($value)) {
            $dateFrom = $this->baseDate($value[0]);
            $dateTo = $this->baseDate($value[1]);

            $query->whereBetween('birth_date', [$dateTo, $dateFrom]);
        } else {
            $date = $this->baseDate($value);

            $query->where('birth_date', $date);
        }

    }

    private function baseDate(int $age): string
    {
        return Carbon::now()->subYear($age)->format('Y-m-d');
    }
}
