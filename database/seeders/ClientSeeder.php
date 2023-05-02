<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\LazyCollection;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        LazyCollection::make(function () {
            $filePath = database_path('dataset.txt');

            $handle = fopen($filePath, 'r');
                while ($line = fgetcsv($handle)) {
                    yield $line;
                }

            fclose($handle);

        })->skip(1) // skip header
            ->chunk(1000) //split in chunk to reduce the number of queries
            ->each(function ($lines) {

                $list = [];
                foreach ($lines as $line) {
                    if (isset($line[0])) {
                        $list[] = [
                            'category' => $line[0],
                            'first_name' => $line[1],
                            'last_name' => $line[2],
                            'email' => $line[3],
                            'gender' => $line[4],
                            'birth_date' => $line[5]
                        ];
                    }
                }

                Client::insert($list);

            });

    }
}
