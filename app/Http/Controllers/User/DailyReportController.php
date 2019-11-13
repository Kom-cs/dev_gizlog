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

    public function index(Request $request)
    {
        $request->validate(
            ['search-month' => 'nullable|date'],
            ['date' => '日付形式で入力してください。']
        );
        $inputMonth = $request->input('search-month');
        $dailyReport = $this->dailyReport->getFilteredReport(Auth::id(), $inputMonth);
        return view('user.daily_report.index', compact('dailyReport'));
    }

    public function showCreateForm()
    {
        return view('user.daily_report.create');
    }

    public function createReport(DailyReportRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->dailyReport->create($input);
        return redirect()->route('daily_report.index');
    }

    public function showDetails($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.show', compact('dailyReport'));
    }

    public function showEditForm($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.edit', compact('dailyReport'));
    }

    public function editReport(DailyReportRequest $request, $id)
    {
        $input = $request->validated();
        $this->dailyReport->find($id)->update($input);
        return redirect()->route('daily_report.index');
    }

    public function deleteReport($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('daily_report.index');
    }

}
