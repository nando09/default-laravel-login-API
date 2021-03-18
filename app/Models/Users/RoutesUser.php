<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutesUser extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
		'user_id',
		'route_id'
    ];

}
