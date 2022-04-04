<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ChangeGroupFormRequest;
use App\Http\Requests\Client\StoreFormRequest;
use App\Http\Requests\Client\UpdateFormRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('view client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $name = $request->input('name');

            $registers = Client::with('group')
                                    ->where(function ($query) use ($name) {
                                        $query->where('clients.client_name', 'LIKE', "%{$name}%");
                                    })
                                    ->get();

            return response()->json(['status' => true, 'data' => $registers]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during access client.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('view client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $registers = Client::with('group')->find($id);

            return response()->json(['status' => true, 'data' => $registers]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during access client.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function store(StoreFormRequest $request): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('store client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $data = $request->validated();
            $register = new Client($data);
            $register->save();

            return response()->json(['status' => true, 'message' => 'Client created.', 'data' => $register]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => false, 'message' => 'Error during create client.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateFormRequest $request, $id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('update client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }

        try {
            $data = $request->validated();
            $register = Client::find($id);
            $register->update($data);

            return response()->json(['status' => true, 'message' => 'Client updated.', 'data' => $register]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during update client.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('destroy client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }

        try {
            $register = Client::find($id);

            $register->delete();

            return response()->json(['status' => true, 'message' => 'Client removed.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during remove client.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function changeGroup(ChangeGroupFormRequest $request)
    {
        if (!auth()->guard('api')->user()->can('update client')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }

        try {
            $data = $request->validated();
            $register = Client::find($data['client_id']);

            $register->update($data);

            return response()->json(['status' => true, 'message' => 'Client changed.']);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['status' => false, 'message' => 'Error during change client.'], status: Response::HTTP_NOT_FOUND);
        }
    }
}
