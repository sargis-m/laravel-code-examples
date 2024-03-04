<?php

use Livewire\Component;
use Livewire\WithPagination;

class PaginationExample extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.pagination-example', [
            'countries' => Countries::paginate(10),
        ]);
    }
}