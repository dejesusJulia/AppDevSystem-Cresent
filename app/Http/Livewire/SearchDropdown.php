<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ApiController;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        $api = new ApiController();
        $user = $api->searchByName($this->search);


        if($user !== null){
            $users = $user->content();
        }

        return view('livewire.search-dropdown', ['searchResults' => json_decode($users)]);
    }
}