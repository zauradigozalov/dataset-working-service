<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Services\ExportCSV;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ClientController extends Controller
{
    public function __construct(
        protected ClientRepository $clientRepository,
        protected ExportCSV $exportCSV
    ) {}

    public function getClients(Request $request): JsonResponse
    {
        return response()->json([
            $this->clientRepository->getUsers($request->per_page)
        ]);
    }

    public function getClientsCSV(): StreamedResponse
    {
        return $this->exportCSV->handle();
    }
}
