<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class AdminPostComponent extends Component
{
    /** @var \App\Models\Post */
    public $post;

    /** @var bool  */
    public $forAdmin;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('components.admin-post');
    }

    public function tags()
    {
        return $this->post->tags->pluck('tag')->implode(' ');
    }

    public function hasLink()
    {
        return filter_var($this->post->link, FILTER_VALIDATE_URL);
    }
}
