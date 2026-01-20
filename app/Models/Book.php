<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Observers\BookObserver;


#[ObservedBy([BookObserver::class])]
class Book extends Model
{
    use HasFactory;
    //
   protected $guarded = [];



   public function user(){
    return $this->belongsTo(User::class);
   }

}
