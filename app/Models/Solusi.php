<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $table = 'solusi_parkirkan';
    protected $fillable = [
        'judul',
        'subjudul',
        'image',
        'solusi',
        'desk_solusi'
    ];
}
