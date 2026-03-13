<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewArticleNotification;
use App\Events\NewArticleEvent;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('article.article', ['articles' => $articles]);
    }

    public function create()
    {
        Gate::authorize('create', Article::class);
        return view('article.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Article::class);

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|min:10',
            'text' => 'required|max:100'
        ]);

        $article = new Article();
        $article->date_public = $request->date;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->users_id = auth()->id();
        $article->save();

        NewArticleEvent::dispatch($article);

        $readers = User::where('id', '!=', auth()->id())->get();
        Notification::send($readers, new NewArticleNotification($article));

        return redirect()->route('article.index')->with('message', 'Create successful');
    }

    public function show(Article $article)
    {
        $comments = Comment::where('article_id', $article->id)
                           ->where('accept', true)
                           ->get();

        return view('article.show', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    public function edit(Article $article)
    {
        Gate::authorize('restore', $article);
        return view('article.edit', ['article' => $article]);
    }

    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article);

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|min:10',
            'text' => 'required|max:100'
        ]);

        $article->date_public = $request->date;
        $article->title = $request->title;
        $article->text = $request->text;
        $article->users_id = auth()->id();
        $article->save();

        return redirect()->route('article.show', $article->id)
                         ->with('message', 'Update successful');
    }

    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);
        $article->delete();

        return redirect()->route('article.index')
                         ->with('message', 'Delete successful');
    }
}
