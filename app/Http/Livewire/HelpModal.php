<?php

namespace App\Http\Livewire;

use App\Models\HelpArticle;
use Livewire\Component;

class HelpModal extends Component
{
    public bool $showModalFlag = false;
    public int $helpArticleId = 0;
    public string $body = '';
    public string $linkText = '';
    public string $name = '';

    public function mount()
    {
        if ($helpArticle = HelpArticle::find($this->helpArticleId)) {
            $this->name = $helpArticle->name;
            $this->body = $helpArticle->body;
            if (! $this->linkText) {
                $this->linkText = $helpArticle->name;
            }
            else {
                // LinkText needs to be passed in pre-translation.
                $this->linkText = __($this->linkText);
            }
        }
        else {
            $this->body = $this->linkText = $this->name = __('Bad Article ID :id', ['id' => $this->helpArticleId]);
        }
    }

    public function render()
    {
        return view('livewire.help-modal');
    }
}
