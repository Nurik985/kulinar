<?php

namespace App\Livewire;

use App\Models\Heading;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class HeadingsTable extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'updated_at';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function render()
    {
        return view(
            'livewire.headings-table',
            [
                'headings' => Heading::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
