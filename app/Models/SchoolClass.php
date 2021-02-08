<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Database\Factories\Administration\FlightFactory;

class SchoolClass extends Model
{
    use HasFactory, Notifiable;

    public function test_models_can_be_instantiated()
    {
        // SchoolClass::factory(10)->create();

        // Use model in tests...
    }
}
