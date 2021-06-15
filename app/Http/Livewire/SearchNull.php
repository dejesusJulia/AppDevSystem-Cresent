<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ApiController;

class SearchNull extends Component
{
    public $nfn = '';
    public function render()
    {
        $api = new ApiController();
        $user = $api->searchByNullCateg($this->nfn);

        if($user !== null){
            $users = $user->content();
        }

        return view('livewire.search-null', ['nfnResults' => json_decode($users)]);
    }
}
