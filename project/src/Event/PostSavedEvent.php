<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class PostSavedEvent extends Event
{
    public const NAME = 'post.saved';

    protected $postData;

    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    public function getPostData()
    {
        return $this->postData;
    }
}