<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Models\Feed;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        //
        return Inertia::render('Feeds/Index', [
            'feeds' => Feed::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->feeds()->create($validated);
 
        return redirect(route('feeds.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feed $feed): RedirectResponse
    {
        Gate::authorize('update', $feed);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $feed->update($validated);
 
        return redirect(route('feeds.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed): RedirectResponse
    {
        Gate::authorize('delete', $feed);
 
        $feed->delete();
 
        return redirect(route('feeds.index'));
    }
}
