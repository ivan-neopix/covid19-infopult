<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostComponent extends Component
{
    /** @var \App\Models\Post */
    public $post;

    /** @var bool  */
    public $forAdmin;

    public function __construct(Post $post, bool $forAdmin = false)
    {
        $this->post = $post;
        $this->forAdmin = $forAdmin;
    }

    public function render()
    {
        return view('components.post');
    }

    public function tags()
    {
        return $this->post->tags;
    }

    public function hasLink()
    {
        return filter_var($this->post->link, FILTER_VALIDATE_URL);
    }
}
