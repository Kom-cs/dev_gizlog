<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function getFilterdQuestions($id, $searchWord)
    {
        $query = $this->where('user_id', $id);
        if (isset($searchWord)) {
            $query = $query->where('title', 'like', '%'.$searchWord.'%');
        }
        $query->pagenate(10);

        return $query->orderBy('id', 'desc')->get();
    }
}

