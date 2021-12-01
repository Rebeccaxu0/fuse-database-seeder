<?php
 
namespace App\Http\Livewire;
 
use App\Contact;
use Livewire\Component;
 
class UserSearchBar extends Component
{
    public $query;
    public $users;
    public $highlightIndex;
 
    public function mount()
    {
        $this->reset();
    }
 
    public function reset()
    {
        $this->query = '';
        $this->users = [];
        $this->highlightIndex = 0;
    }
 
    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->users) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }
 
    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->users) - 1;
            return;
        }
        $this->highlightIndex--;
    }
 
    public function selectUser()
    {
        $user = $this->users[$this->highlightIndex] ?? null;
        if ($user) {
            //$this->redirect(route('', $user['id']));
       }
    }
 
    public function updatedQuery()
    {
        $this->users = Users::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }
 
    public function render()
    {
        return view('livewire.user-search-bar');
    }
}
