<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\ApiController;

class SearchSubject extends Component
{
    public $nfs = ''; // name for subject
    public $subjectId;

    public function render()
    {
        $api = new ApiController();
        $user = $api->searchBySubject((int)$this->subjectId, $this->nfs);

        if($user !== null){
            $users = $user->content();
        }

        return view('livewire.search-subject', ['nfsResults' => json_decode($users)]);
    }
}
