<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Encyclopedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $encyclopedias = Encyclopedia::all();
        return view('admin.articles.create', compact('encyclopedias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:50000',
            'image' => 'nullable|image',
            'encyclopedia_id' => 'required|integer|exists:encyclopedias,id'
        ]);
        /** @var Article $article */
        $article = Article::query()->create($request->all());
        $article->saveImage($request->file('image'));

        return redirect()->route('encyclopedia.article', $article->slug)->with('success', 'Статья добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        $encyclopedias = Encyclopedia::all();
        return view('admin.articles.edit', compact('encyclopedias', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:50000',
            'image' => 'nullable|image',
            'encyclopedia_id' => 'required|integer|exists:encyclopedias,id'
        ]);

        $article->update($request->all());
        $article->saveImage($request->file('image'));
        return redirect()->route('encyclopedia.article', $article->slug)->with('success', 'Статья обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $encyclopediaSlug = $article->encyclopedia->slug;
        $article->delete();
        return redirect()->route('encyclopedia.encyclopedia', $encyclopediaSlug)->with('success', 'Статья удалена');
    }
}
