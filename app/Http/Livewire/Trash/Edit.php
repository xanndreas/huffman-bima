<?php

namespace App\Http\Livewire\Trash;

use App\Models\Draft;
use App\Models\Trash;
use Livewire\Component;

class Edit extends Component
{
    public Trash $trash;

    public array $listsForFields = [];

    public function mount(Trash $trash)
    {
        $this->trash = $trash;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.trash.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->trash->save();

        return redirect()->route('admin.trashes.index');
    }

    protected function rules(): array
    {
        return [
            'trash.draft_id' => [
                'integer',
                'exists:drafts,id',
                'required',
            ],
            'trash.trashed_at' => [
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
