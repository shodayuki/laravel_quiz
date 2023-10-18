<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    public function answer()
    {
        return $this->hasOne('App\Models\Answer', 'id', 'answer_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
