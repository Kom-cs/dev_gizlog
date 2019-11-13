<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $table = 'daily_reports';

    protected $guarded = [];
    
    protected $dates = [
        'reporting_time',
    ];

    public function getFilteredReport($id, $month) 
    {
        $query = $this->where('user_id', $id);
        if (isset($month)){
            $query = $query->where('reporting_time', 'like', '%'.$month.'%');
        }
        return $query->get();
    }
    
}
