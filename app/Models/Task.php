<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type_id',
        'due_date',
        'start_time',
        'duration',
      
        
    ];
    public Function type(){
        return $this->belongsTo(Type::class, 'type_id');
    }
  
}
