<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
	
	protected $fillable = ['name', 'type', 'date_of_birth', 'description', 'image']; // , 'availability'
}
