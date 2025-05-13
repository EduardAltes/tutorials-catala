<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index(Request $request)
    {
        $query = Tutorial::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('summary', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        if ($request->filled('time')) {
            switch ($request->time) {
                case 'short':
                    $query->where('time_required_min', '<=', 15);
                    break;
                case 'medium':
                    $query->whereBetween('time_required_min', [15, 30]);
                    break;
                case 'long':
                    $query->where('time_required_min', '>=', 30);
                    break;
            }
        }

        $tutorials = $query->with('category')->latest()->paginate(10)->appends($request->all());

        return view('tutorials.index', compact('tutorials'));
    }


    public function show($slug)
    {
        $tutorial = Tutorial::where('slug', $slug)->firstOrFail();
        return view('tutorials.show', compact('tutorial'));
    }
}
