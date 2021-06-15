<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ApiController;

class SearchPosition extends Component
{
    public $nfp = '';
    public $positionId;

    public function render()
    {
        $api = new ApiController();
        $user = $api->searchByPosition($this->positionId, $this->nfp);

        if($user !== null){
            $users = $user->content();
        }

        return view('livewire.search-position', ['nfpResults' => json_decode($users)]);
    }
}
