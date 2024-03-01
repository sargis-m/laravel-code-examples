<?php

use Livewire\Component;

class FlashMessageExample extends Component
{
    public Post $post;

    protected $rules = [
        'post.title' => 'required',
    ];

    public function update()
    {
        $this->validate();

        $this->post->save();

        session()->flash('message', 'Post successfully updated.');
    }
}