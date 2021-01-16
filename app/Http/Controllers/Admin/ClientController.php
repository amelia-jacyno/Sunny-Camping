<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientsRepository;

    public function __construct(ClientRepositoryInterface $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    public function addClient()
    {
        return view('admin.clients.client_input_form', ['page' => 'clients', 'nav_items' =>
            config('constants.admin_nav_items'), 'mode' => 'PUT']);
    }

    public function add(Request $request)
    {
        if ($this->clientsRepository->add($request->all())) {
            return true;
        }
        return response('', 406);
    }

    public function edit($id)
    {
        return view('admin.clients.client_input_form', ['page' => 'clients', 'nav_items' =>
            config('constants.admin_nav_items'), 'mode' => 'PATCH', 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        if ($this->clientsRepository->update($id, $request->all())) {
            return true;
        }
        return response('', 406);
    }

    public function delete($id)
    {
        $this->clientsRepository->delete($id);
    }

    public function paginatedJson(Request $request)
    {
        return $this->clientsRepository->paginate($request->toArray())->toJson();
    }

    public function findJson($id)
    {
        return $this->clientsRepository->find($id)->toJson();
    }
}
