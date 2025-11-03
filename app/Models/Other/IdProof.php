<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdProof extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'name',
      'status',
   ];


   
}
