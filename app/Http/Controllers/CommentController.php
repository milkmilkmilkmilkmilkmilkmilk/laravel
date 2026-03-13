<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\Commentmail;
use App\Jobs\VeryLongJob;

class CommentController extends Controller
{
    // Модерация
    public function index()
    {
        // Показываем только комментарии, которые НЕ приняты
        $comments = Comment::where('accept', false)
                           ->latest()
                           ->paginate(10);

        return view('mail.index', ['comments' => $comments]);
    }

    // Добавление комментария
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|min:10',
            'article_id' => 'required|exists:articles,id',
        ]);

        // Создаём комментарий
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = auth()->id();
        $comment->article_id = $request->article_id;
        $comment->accept = false;
        $comment->save();

     // Диспетчер очереди вместо прямого отправления
        $article = $comment->article;
        $author = $comment->user->name;

        VeryLongJob::dispatch($comment, $article, $author);

        return redirect()
            ->route('article.show', $request->article_id)
            ->with('message', 'Комментарий успешно добавлен и отправлен на модерацию.');
    }

    // Редактирование
    public function edit(Comment $comment)
    {
        Gate::authorize('update', $comment);
        return view('comment.edit', ['comment' => $comment]);
    }

    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $request->validate([
            'text' => 'required|min:10',
        ]);

        $comment->text = $request->text;
        $comment->save();

        return redirect()->route('article.show', $comment->article_id);
    }

    // Удаление
    public function delete(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        return redirect()->back();
    }

    // Принять комментарий
    public function accept(Comment $comment)
    {
        $comment->accept = true;
        $comment->save();

        return redirect()->route('comments.moderation')
            ->with('message', 'Комментарий одобрен.');
    }

    // Отклонить комментарий
    public function reject(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.moderation')
            ->with('message', 'Комментарий отклонён.');
    }
}
