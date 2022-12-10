<?php

namespace App\Http\Livewire\Draft;

use App\Models\Draft;
use Livewire\Component;

class Create extends Component
{
    public Draft $draft;

    public function mount(Draft $draft)
    {
        $this->draft = $draft;
    }

    public function render()
    {
        return view('livewire.draft.create');
    }

    public function submit()
    {
        $this->validate();

        $this->draft->save();

        return redirect()->route('admin.drafts.index');
    }

    protected function rules(): array
    {
        return [
            'draft.to' => [
                'string',
                'required',
            ],
            'draft.cc' => [
                'string',
                'nullable',
            ],
            'draft.bcc' => [
                'string',
                'nullable',
            ],
            'draft.subject' => [
                'string',
                'required',
            ],
            'draft.message' => [
                'string',
                'required',
            ],
        ];
    }
}
