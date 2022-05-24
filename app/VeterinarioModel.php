<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\VeterinarioModel as Authenticatable;


class VeterinarioModel extends Model
{
    use HasApiTokens, Notifiable;
    protected $table = 'users';

}
