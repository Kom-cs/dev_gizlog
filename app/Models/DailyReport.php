<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $table = 'daily_reports';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'reporting_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
