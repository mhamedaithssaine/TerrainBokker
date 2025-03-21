<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index() {
        $sponsors = Sponsor::all();
        return view("sponsors.index", compact("sponsors"));
    }

    public function create(){
    return view("sponsors.create");
    }
}
