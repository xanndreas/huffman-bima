<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Resources\Admin\SettingResource;
use App\Models\Setting;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SettingResource(Setting::all());
    }

    public function store(StoreSettingRequest $request)
    {
        $setting = Setting::create($request->validated());

        return (new SettingResource($setting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Setting $setting)
    {
        abort_if(Gate::denies('setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SettingResource($setting);
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return (new SettingResource($setting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
