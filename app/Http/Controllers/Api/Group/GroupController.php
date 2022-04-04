<?php

namespace App\Http\Controllers\Api\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\StoreFormRequest;
use App\Http\Requests\Group\UpdateFormRequest;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('view group')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $name = $request->input('name');
            
            $registers = Group::with('clients')
                                    ->where(function ($query) use ($name) {
                                        $query->where('groups.group_name', 'LIKE', "%{$name}%");
                                    })
                                    ->get();

            return response()->json(['status' => true, 'data' => $registers]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during access group.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('view group')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $registers = Group::with('clients')->find($id);

            return response()->json(['status' => true, 'data' => $registers]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during access group.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function store(StoreFormRequest $request): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('store group')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }
        try {
            $data = $request->validated();
            $register = new Group($data);
            $register->save();

            return response()->json(['status' => true, 'message' => 'Group created.', 'data' => $register]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during create group.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateFormRequest $request, $id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('update group')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }

        try {
            $data = $request->validated();
            $register = Group::find($id);
            $register->update($data);

            return response()->json(['status' => true, 'message' => 'Group updated.', 'data' => $register]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during update group.'], status: Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (!auth()->guard('api')->user()->can('destroy group')) {
            return response()->json(['message' => 'You are not allowed to use this resource!'], status: Response::HTTP_FORBIDDEN);
        }

        try {
            $register = Group::find($id);

            $register->delete();

            return response()->json(['status' => true, 'message' => 'Group removed.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Error during remove group.'], status: Response::HTTP_NOT_FOUND);
        }
    }
}
