<?php

namespace App\Models;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Barber extends Model
{
    /** @use HasFactory<\Database\Factories\BarberFactory> */
    use HasFactory;

    function appointments() {
        return $this->hasMany(Appointment::class);
    }   

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
}
