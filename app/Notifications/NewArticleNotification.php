<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewArticleNotification extends Notification
{
    public function __construct(public $article) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'article_id' => $this->article->id,
            'title' => $this->article->title,
        ];
    }
}
