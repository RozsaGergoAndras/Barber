<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Barber;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments, 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
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
                'name' => 'required|string|max: 255',
                'barber_id' => 'required|integer',
                'appointment_date' => 'required|date'
            ],
            [
                'name.required' => 'A név megadása kötelező',
                'name.String' => 'A név csak szöveg lehet',
                'name.max' => 'A név maximum 255 karakter lehet',
                'barber_id.required' => 'A fodrász megadása kötelező',
                'barber_id.integer' => 'A fodrász csak szám lehet',
                'appointment_date.required' => 'Az időpont megadása kötelező',
                'appointment_date.date' => 'Az időpont csak dátum lehet'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' =>$e->getMessage(),
            ], 400);
        }
        try {
            $barber = Barber::findOrFail($request->input('barber_id'));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Ilyen barber nem létezik',
            ], 400);
        }

       $appointment = Appointment::create([
            "name" => $request->input('name'),
            "barber_id" => $request->input('barber_id'),
            "appointment_date" => $request->input('appointment_date')
       ]);

       return response()->json(["succes" => true, "uzenet" => $appointment->name . $appointment->barber_id .  $appointment->appointment_date .  " rögzítve!"], 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $appointment = appointment::find($request->id);
        $appointment->delete();
        return response()->json(["success" => true, "uzenet" => $appointment->appointment_date . "+" .$appointment->name . " törölve!"], 200, ["Access-Control-Allow-Origin" => "*"], JSON_UNESCAPED_UNICODE);
    }
}
