<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class AjaxController extends Controller
{
    public function workshop(Request $request)
    {
        $package = $request->package;
        $id = $request->level;
        $level = Level::find($id);
        $workshops = $level->events;
        if ($package == 1) {
            $workshops = $workshops->where('category', 'symposium');
        } elseif ($package == 2) {
            $workshops = $workshops->where('category', 'workshop');
        }
        return response()->json($workshops);
    }
}
