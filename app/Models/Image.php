<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    
    use HasFactory;
    
    protected $table = 'image';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'name'];
    
    public function reviews() {
        return $this->hasMany('App\Models\Review', 'idimage');
    }
    
}
