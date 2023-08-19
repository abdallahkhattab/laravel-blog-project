<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testemonial extends Model
{
    use HasFactory;

    protected $fillable = ['avatar','name_en','name_ar','title_job_en',
      'title_job_ar','rate','description_en','description_ar'];
     
}
