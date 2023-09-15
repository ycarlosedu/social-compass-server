<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

abstract class CustomModel extends Model
{
    use Authenticatable, Authorizable;

    const CREATED_AT = 'data_criacao';
    const UPDATED_AT = 'data_alteracao';

}
