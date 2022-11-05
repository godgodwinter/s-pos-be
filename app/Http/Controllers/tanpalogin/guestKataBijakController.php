<?php

namespace App\Http\Controllers\tanpalogin;

use App\Http\Controllers\Controller;
use App\Models\katabijakdetail;
use Illuminate\Http\Request;

class guestKataBijakController extends Controller
{
    public function index()
    {
        $items = katabijakdetail::with('katabijak')->inRandomOrder()->limit(10)->get();
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
}
