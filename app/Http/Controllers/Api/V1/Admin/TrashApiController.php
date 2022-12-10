<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrashRequest;
use App\Http\Requests\UpdateTrashRequest;
use App\Http\Resources\Admin\TrashResource;
use App\Models\Trash;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrashApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('trash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrashResource(Trash::with(['draft'])->get());
    }

    public function store(StoreTrashRequest $request)
    {
        $trash = Trash::create($request->validated());

        return (new TrashResource($trash))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Trash $trash)
    {
        abort_if(Gate::denies('trash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TrashResource($trash->load(['draft']));
    }

    public function update(UpdateTrashRequest $request, Trash $trash)
    {
        $trash->update($request->validated());

        return (new TrashResource($trash))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Trash $trash)
    {
        abort_if(Gate::denies('trash_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trash->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
