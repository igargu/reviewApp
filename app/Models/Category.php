<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    
    use HasFactory;
    
    protected $table = 'category';
    
    public $timestamps = false;
    
    protected $fillable = ['id', 'name'];
    
    public function reviews() {
        return $this->hasMany('App\Models\Review', 'idcategory');
    }
}
