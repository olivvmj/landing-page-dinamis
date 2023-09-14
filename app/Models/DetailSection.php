<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Section;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

//product
class DetailSection extends Model
{
    protected $table = 'section_detail';
    protected $fillable = [
        'section_id',
        'image',
        'title',
        'desc',
    ];

    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}

