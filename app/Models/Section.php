<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\SectionType;
use App\Models\DetailSection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

//product
class Section extends Model
{
    protected $table = 'section';
    protected $fillable = [
        'type_id',
        'title',
        'title_highlight',
        'menu',
        'description',
        'image',
        'section_code'
    ];

    public function SectionType()
    {
        return $this->belongsTo(SectionType::class, 'type_id', 'id');
    }

    public function Detail(){
        return $this->belongsTo(DetailSection::class, 'type_id', 'id');
    }
}

