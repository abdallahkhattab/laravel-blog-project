<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable =[
   'image','name_en','name_ar',
   'description_en','description_ar',
   'facebook','twitter','linkedin',
   'youtube'
    ];
}
