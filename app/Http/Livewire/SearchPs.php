<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ApiController;

class SearchPs extends Component
{
    public $nfps = ''; 
    public $positionId;
    public $subjectId;

    public function render()
    {
        $api = new ApiController();
        $user = $api->searchByPS($this->subjectId, $this->positionId, $this->nfps);

        if($user !== null){
            $users = $user->content();
        }

        return view('livewire.search-ps', ['nfpsResults' => json_decode($users)]);
    }
}
