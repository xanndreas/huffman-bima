<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDraftRequest;
use App\Http\Requests\UpdateDraftRequest;
use App\Http\Resources\Admin\DraftResource;
use App\Models\Draft;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DraftApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('draft_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DraftResource(Draft::all());
    }

    public function store(StoreDraftRequest $request)
    {
        $draft = Draft::create($request->validated());

        return (new DraftResource($draft))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Draft $draft)
    {
        abort_if(Gate::denies('draft_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DraftResource($draft);
    }

    public function update(UpdateDraftRequest $request, Draft $draft)
    {
        $draft->update($request->validated());

        return (new DraftResource($draft))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Draft $draft)
    {
        abort_if(Gate::denies('draft_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $draft->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
