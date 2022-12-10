<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sent;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sent.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sent.create');
    }

    public function edit(Sent $sent)
    {
        abort_if(Gate::denies('sent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sent.edit', compact('sent'));
    }

    public function show(Sent $sent)
    {
        abort_if(Gate::denies('sent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sent->load('draft');

        return view('admin.sent.show', compact('sent'));
    }
}
