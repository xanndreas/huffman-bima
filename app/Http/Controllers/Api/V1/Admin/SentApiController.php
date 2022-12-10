<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSentRequest;
use App\Http\Requests\UpdateSentRequest;
use App\Http\Resources\Admin\SentResource;
use App\Models\Sent;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SentResource(Sent::with(['draft'])->get());
    }

    public function store(StoreSentRequest $request)
    {
        $sent = Sent::create($request->validated());

        return (new SentResource($sent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Sent $sent)
    {
        abort_if(Gate::denies('sent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SentResource($sent->load(['draft']));
    }

    public function update(UpdateSentRequest $request, Sent $sent)
    {
        $sent->update($request->validated());

        return (new SentResource($sent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Sent $sent)
    {
        abort_if(Gate::denies('sent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
