<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\ServicioModel as Authenticatable;

class MascotasModel extends Model
{
    public function getAuthIdentifier()
    {
    
    }
    protected $table = 'mascotas';
}
