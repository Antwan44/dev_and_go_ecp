<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'birthday', 'street_number', 'street_name', 'zip_code', 'city', 'birthday', 'special_note', 'lat', 'lng'
    ];
}
