<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->latest()->get();
        // dd($feedbacks);
        return view('dashboard.feedback', compact('feedbacks'));
    }

    public function updateStatus(Request $request, Feedback $feedback)
    {

         
        $request->validate([
            'status' => 'required|in:publier,cacher',
        ]);
        // dd($request);

        $feedback->update(['status' => $request->status]);

        return redirect()->route('dashboard.feedback.index')->with('success', 'Statut du feedback mis à jour.');
    }
}
