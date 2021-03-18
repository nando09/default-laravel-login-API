<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutesProfile extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
		'profile_id',
		'route_id'
    ];
}
