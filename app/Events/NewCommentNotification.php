<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewArticleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $articleTitle;
    public $articleId;

    public function __construct($articleTitle, $articleId)
    {
        $this->articleTitle = $articleTitle;
        $this->articleId = $articleId;
    }

    // Канал вещания (заменяем PrivateChannel на Channel)
    public function broadcastOn()
    {
        return new Channel('articles-channel');
    }

    // Данные, которые придут на фронтенд
    public function broadcastWith()
    {
        return [
            'title' => $this->articleTitle,
            'id' => $this->articleId
        ];
    }

    public function broadcastAs()
    {
        return 'new-article';
    }
}
