<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Edit extends Component
{
    public Setting $setting;

    public function mount(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function render()
    {
        return view('livewire.setting.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->setting->save();

        return redirect()->route('admin.settings.index');
    }

    protected function rules(): array
    {
        return [
            'setting.outgoing_server' => [
                'string',
                'required',
            ],
            'setting.outgoing_port' => [
                'string',
                'required',
            ],
            'setting.incoming_server' => [
                'string',
                'required',
            ],
            'setting.incoming_port' => [
                'string',
                'required',
            ],
        ];
    }
}
