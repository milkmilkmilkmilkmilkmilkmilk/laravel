namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentModerationNotify extends Notification
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
            ->subject('Новый комментарий требует модерации')
            ->markdown('mail.comment_moderation', [
                'comment' => $this->comment,
                'article_title' => $this->articleTitle,
                'author' => $this->author,
            ]);
    }
}
