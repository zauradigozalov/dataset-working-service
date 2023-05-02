<?php

namespace App\Services;

use App\Filters\AgeRangeFilter;
use App\Models\Client;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportCSV
{
    public function handle(): StreamedResponse
    {

        $collection = QueryBuilder::for(Client::class)
            ->allowedFilters(
                [
                    AllowedFilter::exact('category'),
                    AllowedFilter::exact('gender'),
                    AllowedFilter::scope('date_of_birth'),
                    AllowedFilter::custom('age_range', new AgeRangeFilter(), null, '-')

                ]
            )->get(['category', 'first_name', 'last_name', 'email', 'gender', 'birth_date']);

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="clients.csv"',
        ];

        $callback = function () use ($collection) {
            $file = fopen('php://output', 'w');

            foreach ($collection as $row) {
                fputcsv($file, $row->toArray());
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
