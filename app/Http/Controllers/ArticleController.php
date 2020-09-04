<?php

namespace App\Http\Controllers;

use App\Article;
use App\Encyclopedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $encyclopedias = Encyclopedia::all();
        return view('admin.articles.create', compact('encyclopedia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'content' => 'required|string|max:255',
            'encyclopedia_id' => 'required|integer|exists:encyclopedias,id'
        ]);

        $article = Article::create($request->all());
        $article->saveImage($request->file('image'));
        return redirect()->back()->with('success', "Статья \"${$article->title}\" создана");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('encyclopedia.article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $encyclopedias = Encyclopedia::all();
        return view('admin.articles.edit', compact('encyclopedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'content' => 'required|string|max:255',
            'encyclopedia_id' => 'required|integer|exists:encyclopedias,id'
        ]);
        $article->update($request->all());
        $article->saveImage($request->file('image'));
        return redirect()->route('articles.show', $article->slug)->with('success', 'Статья изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $encyclopedia = $article->encyclopedia;
        $article->delete();
        return redirect()->route('encyclopedias.show', $encyclopedia->slug)->with('success', 'Статья удалена');
    }
}
