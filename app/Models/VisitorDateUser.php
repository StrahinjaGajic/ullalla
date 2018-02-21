<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorDateUser extends Model
{
    protected $table = 'visitor_date_user';

    protected $fillable = [
        'visitors', 'active'
    ];
}
