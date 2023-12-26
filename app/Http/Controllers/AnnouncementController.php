<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('account.announcement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();

        return view('account.announcement.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $announcement = Announcement::create($request->all());
        $announcement->user_id = auth()->user()->id;
        $announcement->save();
        return redirect()->back()->with(['success' => "{__('ui.AnnCorrect')}"]);
    }

    /**
     * Display the specified resource.
     */
    public function showAnnouncement(Announcement $announcement)
    {

        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('account.announcement.editAnnouncement', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //
    }
}
