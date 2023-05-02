<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function scopeDateOfBirth(Builder $query, $date): Builder
    {
        return $query->where('birth_date', Carbon::parse($date)->format('Y-d-m'));
    }
}
