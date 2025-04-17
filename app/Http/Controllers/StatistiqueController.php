<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')
                             ->where('status', 'cacher')
                             ->orderBy('created_at', 'desc')
                             ->take(3)
                             ->get()
                             ->map(function ($feedback) {
                                 $feedback->date = \Carbon\Carbon::parse($feedback->created_at)->diffForHumans();
                                 return $feedback;
                             });

        return view('components.feedbackrecents', compact('feedbacks'));
}

}