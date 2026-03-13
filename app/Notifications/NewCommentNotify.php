namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class NewCommentNotify extends Notification
{
    use Queueable;

    public $comment;
    public $articleTitle;
    public $author;

    public function __construct($comment, $articleTitle, $author)
    {
        $this->comment = $comment;
        $this->articleTitle = $articleTitle;
        $this->author = $author;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новый комментарий')
            ->markdown('mail.comment', [
                'comment' => $this->comment,
                'article_title' => $this->articleTitle,
                'author' => $this->author,
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'comment_id' => $this->comment->id,
            'article_title' => $this->articleTitle,
            'author' => $this->author,
        ];
    }
}
