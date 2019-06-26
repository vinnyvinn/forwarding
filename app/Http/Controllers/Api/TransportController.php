<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportController extends Controller
{
    public function physicalVerification(Request $request)
    {
        return response()->json(['success'=>'got here']);
    }
}
