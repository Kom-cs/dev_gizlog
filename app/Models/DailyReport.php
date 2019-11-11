<?php

namespace App\Models;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $table = 'daily_reports';

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
    ];
    
    protected $dates = [
        'reporting_time',
    ];

    // public function getByUserId($id)
    // {
    //     return $this->where('user_id', $id)->get();
    // }

    public function getFilteredReport($id, $month) 
    {
        $query = $this->where('user_id', $id);
        if (isset($month)){
            $query = $query->where('reporting_time', 'like', '%'.$month.'%');
        }
        return $query->get();
        dd($query);
    }
    
}
