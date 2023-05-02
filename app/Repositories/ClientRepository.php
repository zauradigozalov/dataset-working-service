<?php

namespace App\Repositories;

use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function getUsers($per_page = 20)
    {
        return Client::paginate($per_page);
    }


}
