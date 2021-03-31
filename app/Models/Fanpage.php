<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fanpage extends Model
{
    use HasFactory;
    protected $fillable = [
            'nazwa',
            'app_id',
            'fanpage_id',
            'fanpage_token'];
}
