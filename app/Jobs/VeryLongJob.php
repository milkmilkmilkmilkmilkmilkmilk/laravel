<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Mail\Commentmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;
    public $article;
    public $author;

    /**
     * Create a new job instance.
     */
    public function __construct(Comment $comment, $article, $author)
    {
        $this->comment = $comment;
        $this->article = $article;
        $this->author = $author;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('p.nazarenko04@mail.ru')
            ->send(new Commentmail($this->comment, $this->article, $this->author));
    }
}
