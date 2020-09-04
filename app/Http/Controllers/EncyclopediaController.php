<?php

namespace App\Http\Controllers;

use App\Encyclopedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncyclopediaController extends Controller
{

    public function index()
    {
        $encyclopedias = Encyclopedia::all();
        return view('encyplopedia.index', compact('encyclopedia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.encyclopedia.create');
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
            'title' => 'required|stirng|max:255'
        ]);
        $encyclopedia = Encyclopedia::create($request->all());
        return redirect()->back()->with('success', "Энциклопедия \"{$encyclopedia->title}\" добавлена");
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Encyclopedia $encyclopedia)
    {
        return view('admin.encyclopedia.edit', $encyclopedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encyclopedia $encyclopedia)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);
        $encyclopedia->update($request->all());
        return redirect()->back()->with('success', 'Энциклопедия отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encyclopedia $encyclopedia)
    {
        $encyclopedia->delete();
        return redirect()->back()->with('success', 'Экнциклопедия удалена');
    }
}
