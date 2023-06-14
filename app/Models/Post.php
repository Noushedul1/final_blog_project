<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'category_id',
        'status',
        'subtitle'
    ];
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
}
