<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
     public function index()
    {
        $testimonials = Testimonial::with('user')->latest()->get();

        return view('main', compact('testimonials'));
    }
}
