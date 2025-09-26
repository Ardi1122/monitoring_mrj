<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = Education::query();

        // Filter by type if requested
        if ($request->has('type') && in_array($request->type, ['video', 'ebook', 'poster'])) {
            $query->where('type', $request->type);
        }

        // Search by title or description
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Get all results
        $educations = $query->orderBy('is_popular', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah total untuk setiap type
        $counts = [
            'all' => Education::count(),
            'video' => Education::where('type', 'video')->count(),
            'ebook' => Education::where('type', 'ebook')->count(),
            'poster' => Education::where('type', 'poster')->count(),
        ];

        return view('ibu_hamil.education', compact('educations', 'counts'));
    }
}
