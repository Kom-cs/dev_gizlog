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

    public function getFilterdQuestions($request)
    {
        $request->validate([
            'search_word' => 'nullable|string',
            'tag_category_id' => 'nullable|int|between:0,4',
            ]);
        $input = $request->only(['search_word', 'tag_category_id']);
        $question = $this->with(['comment', 'tagCategory', 'user']);
        if (isset($input['search_word'])) {
            $question = $question->where('title', 'like', '%'.$input['search_word'].'%');
        }
        if (isset($input['tag_category_id']) && $input['tag_category_id'] != 0) {
            $question = $question->where('tag_category_id', $input['tag_category_id']);
        }
        return $question->orderBy('updated_at', 'desc')
                        ->paginate(10);
    }

    /**
     * コメント取得
     *
     * @return App\Models\Comment
     */
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * タグカテゴリー取得
     *
     * @return App\Models\TagCategory
     */
    public function tagCategory()
    {
        return $this->hasOne('App\Models\TagCategory', 'id', 'tag_category_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}

