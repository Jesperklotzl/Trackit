<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $lastTracked = $user->latest_track_time;
        $tracks = $user->tracks;


        return Inertia::render('Tracker', []);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Track::create([
            'user_id' => auth()->user()->id
        ]);

    }
}
