<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\RoomType;

class AjaxController extends Controller
{
    public function workshop(Request $request)
    {
        $package = $request->package;
        $id = $request->level;
        $level = Level::find($id);
        $workshops = $level->events->whereNotIn('id', [3,5]);
        if ($package == 1) {
            $workshops = $workshops->where('category', 'symposium');
        } elseif ($package == 2) {
            $workshops = $workshops->where('category', 'workshop');
        }
        return response()->json($workshops);
    }

    public function roomTypes(Request $request)
    {
        $accommodation_id = $request->id;
        $rooms = RoomType::where('accommodation_id', $accommodation_id)->get();
        return response()->json($rooms);
    }
}
