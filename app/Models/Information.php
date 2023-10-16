<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = ['information'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y/m/d');
    }
}
