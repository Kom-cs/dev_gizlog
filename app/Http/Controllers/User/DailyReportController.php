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
     * 日報の一覧表示と入力した月での検索。
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
     * 日報作成ページの表示。
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showCreateForm()
    {
        return view('user.daily_report.create');
    }

    /**
     * 作成した日報をDBに登録。
     *
     * @param App\Http\Requests\User\DailyReportRequest $request
     * @param array $input
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
     * 選択した日報の詳細を表示。
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
     * 選択した日報の編集ページを表示。
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
     * 日報を編集してDBを更新。
     *
     * @param App\Http\Requests\User\DailyReportRequest $request
     * @param int $id
     * @param array $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editReport(DailyReportRequest $request, $id)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->dailyReport->find($id)->fill($input)->save();
        return redirect()->route('daily_report.index');
    }

    /**
     * 日報を論理削除してブラウザの表示対象から除外。
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
