<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barber;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    /** @use HasFactory<\Database\Factories\AppointmentFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ["barber_id","name","appointment_date"];

    function barber() {
        return $this->belongsTo(Barber::class);
    }
}
