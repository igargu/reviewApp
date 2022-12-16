<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    
    use HasFactory;
    
    protected $table = 'review';
    
    public $timestamps = true;
    
    protected $fillable = ['id', 'type', 'title', 'review', 
                           'iduser', 'idimage', 'idcategory', 'rate'];
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
    
    public function image() {
        return $this->belongsTo('App\Models\Image', 'idimage');
    }
    
    public function category() {
        return $this->belongsTo('App\Models\Category', 'idcategory');
    }
}
