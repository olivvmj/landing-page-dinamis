<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manfaat extends Model
{
    protected $table = 'manfaat_parkirkan';
    protected $fillable = [
        'judul',
        'subjudul',
        'image',
        'manfaat'
    ];
}
