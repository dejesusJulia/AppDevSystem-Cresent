<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Client;
use App\User;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.name', 'LIKE', '%'. $this->search. '%')->get();

        if($users !== null){
            $users = json_encode($users);
        }
        return view('livewire.search-dropdown', ['searchResults' => $users]);
    }
}
