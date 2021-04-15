<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "products";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
