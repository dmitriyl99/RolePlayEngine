<?php

namespace App\Http\Controllers\Admin;

use App\Encyclopedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncyclopediaController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.encyclopedia.create');
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
            'description' => 'nullable|string|max:255'
        ]);
        $encyclopedia = Encyclopedia::create($request->all());
        return redirect()->back()->with('success', "Энциклопедия \"{$encyclopedia->title}\" добавлена");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encyclopedia  $encyclopedium
     * @return \Illuminate\View\View
     */
    public function edit(Encyclopedia $encyclopedium)
    {
        return view('admin.encyclopedia.edit', compact('encyclopedium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encyclopedia  $encyclopedium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Encyclopedia $encyclopedium)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);
        $encyclopedium->update($request->all());
        return redirect()->route('encyclopedia.index')->with('success', 'Энциклопедия отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encyclopedia  $encyclopedium
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Encyclopedia $encyclopedium)
    {
        $encyclopedium->delete();
        return redirect()->back()->with('success', 'Экнциклопедия удалена');
    }
}
