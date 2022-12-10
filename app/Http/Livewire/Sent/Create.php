<?php

namespace App\Http\Livewire\Sent;

use App\Models\Draft;
use App\Models\Sent;
use Livewire\Component;

class Create extends Component
{
    public Sent $sent;

    public array $listsForFields = [];

    public function mount(Sent $sent)
    {
        $this->sent = $sent;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.sent.create');
    }

    public function submit()
    {
        $this->validate();

        $this->sent->save();

        return redirect()->route('admin.sents.index');
    }

    protected function rules(): array
    {
        return [
            'sent.draft_id' => [
                'integer',
                'exists:drafts,id',
                'required',
            ],
            'sent.sent_at' => [
                'required',
                'date_format:' . config('project.datetime_format'),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['draft'] = Draft::pluck('to', 'id')->toArray();
    }
}
