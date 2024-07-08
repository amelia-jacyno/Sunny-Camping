<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function dashboard()
    {
        return view('admin.dashboard', ['page' => 'dashboard']);
    }

    public function clients(Request $request)
    {
        $paginatedClients = $this->clientRepository->paginatedSearch($request->query());
        $clientNames = $this->clientRepository->findCurrentClientNames()->map(fn ($item) => $item->name)->sort()->values();
        $assignedTokens = $this->clientRepository->findCurrentAssignedTokens()->map(fn ($item) => $item->token_number)->sort()->values();

        return view('admin.clients', [
            'page' => 'clients',
            'pagination' => $paginatedClients->onEachSide(0)->links(),
            'clients' => $paginatedClients->toJson(),
            'filters' => collect($request->query())->toJson(),
            'clientNames' => $clientNames->toJson(),
            'assignedTokens' => $assignedTokens->toJson(),
        ]);
    }

    public function bills()
    {
        return view('admin.bills', ['page' => 'bills']);
    }
}
