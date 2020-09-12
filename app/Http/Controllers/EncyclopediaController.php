<?php

namespace App\Http\Controllers;

use App\Article;
use App\Encyclopedia;
use Illuminate\Http\Request;

class EncyclopediaController extends Controller
{
    /**
     * Show all encyclopedia categories
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $encyclopedias = Encyclopedia::all();
        return view('encyclopedia.index', compact('encyclopedias'));
    }

    /**
     * Show concrete category of encyclopedia
     *
     * @param Encyclopedia $encyclopedia
     * @return \Illuminate\View\View
     */
    public function encyclopedia(Encyclopedia $encyclopedia)
    {
        return view('encyclopedia.encyclopedia', compact('encyclopedia'));
    }

    /**
     * Show concrete article of encyclopedia
     *
     * @param Encyclopedia $encyclopedia
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function article(Encyclopedia $encyclopedia, Article $article)
    {
        return view('encyclopedia.article', compact('article', 'encyclopedia'));
    }
}
