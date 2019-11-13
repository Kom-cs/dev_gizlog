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

    /**
     * Diplay the list of the resource.
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

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
    
    /**
     * Show the form to create a new resuorce.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showCreateForm()
    {
        return view('user.daily_report.create');
    }

    /**
     * Store and create a new resource in the storage.
     *
     * @param App\Http\Requests\User\DailyReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function createReport(DailyReportRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->dailyReport->create($input);
        return redirect()->route('daily_report.index');
    }

    /**
     * Display the whole specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showDetails($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.show', compact('dailyReport'));
    }

    /**
     * Show the form to edit the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showEditForm($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.edit', compact('dailyReport'));
    }

    /**
     * Edit and update the specified resource in the storage.
     *
     * @param App\Http\Requests\User\DailyReportRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editReport(DailyReportRequest $request, $id)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->dailyReport->find($id)->update($input);
        return redirect()->route('daily_report.index');
    }

    /**
     * Remove the specified resource from the strage using SoftDeletes.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteReport($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('daily_report.index');
    }

}
