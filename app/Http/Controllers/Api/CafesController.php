<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCafeRequest;
use App\Models\Cafe;

class CafesController extends Controller
{
    public function getCafes()
    {
        $cafes = Cafe::all();
        return response()->json($cafes);
    }
    public function getCafe(Cafe $cafe)
    {
        return response()->json($cafe);
    }
    public function postNewCafe(StoreCafeRequest $request)
    {
        $cafe = new Cafe();
        $cafe->name = $request->name;
        $cafe->address = $request->address;
        $cafe->city = $request->city;
        $cafe->state = $request->state;
        $cafe->zip = $request->zip;
        $cafe->save();
        return response()->json($cafe, 201);
    }
}
