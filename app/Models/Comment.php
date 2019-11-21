<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $filable = [
        'user_id',
        'question_id',
        'commment',
    ];

    public function getFilterdComments($id, $searchWord)
    {
        $query = $this->where('user_id', $id);
        if (isset($searchWord)) {
            $query = $query->where('title', 'like', '%'.$searchWord.'%');
        }
        $query->pagenate(10);
    }
}
