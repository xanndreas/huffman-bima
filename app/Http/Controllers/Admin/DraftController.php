<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DraftController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('draft_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.draft.index');
    }

    public function create()
    {
        abort_if(Gate::denies('draft_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.draft.create');
    }

    public function edit(Draft $draft)
    {
        abort_if(Gate::denies('draft_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.draft.edit', compact('draft'));
    }

    public function show(Draft $draft)
    {
        abort_if(Gate::denies('draft_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.draft.show', compact('draft'));
    }
}
