<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['title_ar','title_en','image','price','title_time_en','title_time_ar','hdd_en',  'email_num',  'subdomain_num',
    'database_num',    'support_type',      
    ];
}
