<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitur extends Model
{
    protected $table = 'fitur_parkirkan';
    protected $fillable = [
        'judul',
        'subjudul',
        'image',
        'fitur',
        'desk_fitur'
    ];
}
