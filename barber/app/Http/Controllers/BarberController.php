<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBarberRequest;
use App\Http\Requests\UpdateBarberRequest;
use Nette\Schema\ValidationException;


class BarberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barbers = Barber::all();
        return response()->json($barbers, 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
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
                'message' => 'Validációs hiba',
            ], 400);
        }

       $barber = Barber::create([
        "barber_name" => $request->input('barber_name'),
       ]);

       return response()->json(["success" => true, "uzenet" => $barber->barber_name . " rögzítve!"], 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
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
    public function destroy(Request $request)
    {
        $barber = Barber::find($request->id);
        $barber->delete();
        return response()->json(["success" => true, "uzenet" => $barber->barber_name . " törölve!"], 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
    }
}
