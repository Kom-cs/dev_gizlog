<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyReportController extends Controller
{
    protected $dailyReport;

    public function __construct(DailyReport $dailyReport)
    {
        $this->middleware('auth');
        $this->dailyReport = $dailyReport;
    }

    public function index()
    {
        $daily_reports = $this->dailyReport->getByUserId(Auth::id());
        return view('user.daily_report.index', compact('daily_reports'));
    }

    public function showCreateForm()
    {
        return view('user.daily_report.create');
    }

    public function createReport(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        // dd($input);
        $this->dailyReport->fill($input)->save();
        return redirect()->route('daily_report.index');
    }

    public function showEditForm()
    {
        return view('user.daily_report.edit');
    }

    public function editReport(){}

    public function showDetails()
    {
        return view('user.daily_report.show');
    }

    public function deleteReport($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('daily_report.index');
    }
}
