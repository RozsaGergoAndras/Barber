<?php

namespace App\Models;

use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barber extends Model
{
    /** @use HasFactory<\Database\Factories\BarberFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ["barber_name"];

    function appointments() {
        return $this->hasMany(Appointment::class);
    }   

    
}
