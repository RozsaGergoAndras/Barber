<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Http\Requests\StoreBarberRequest;
use App\Http\Requests\UpdateBarberRequest;

class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        try {
            $request->validate([
                'barber_name' => 'required|max: 255'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
            ], 400);
        }

        return response()->json($barber, 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barber $barber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barber $barber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarberRequest $request, Barber $barber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barber $barber)
    {
        //
    }
}
