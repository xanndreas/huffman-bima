<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trash;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrashController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('trash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trash.index');
    }

    public function create()
    {
        abort_if(Gate::denies('trash_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trash.create');
    }

    public function edit(Trash $trash)
    {
        abort_if(Gate::denies('trash_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trash.edit', compact('trash'));
    }

    public function show(Trash $trash)
    {
        abort_if(Gate::denies('trash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trash->load('draft');

        return view('admin.trash.show', compact('trash'));
    }
}
