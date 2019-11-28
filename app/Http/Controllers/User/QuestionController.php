<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Models\Question;
use App\Models\TagCategory;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuestionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(Question $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, TagCategory $tagCategory, User $user)
    {
        $questions = $this->question->getFilterdQuestions($request);
        $categories = $tagCategory->getTags();
        return view('user.question.index', compact('questions','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TagCategory $tagCategory)
    {
        $tags = $tagCategory->getTags();
        return view('user.question.create', compact('tags'));
    }

    /** 
     * 
    */
    public function showConfirm(QuestionsRequest $request, User $user)
    {
        $input = $request->validated();
        $user = $user->getUserById(Auth::id());
        return view('user.question.confirm', compact('user'))->with($input);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = Auth::id();
        $this->question->create($input);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, User $user)
    {
        $question = $this->question->with(['comment', 'tagCategory', 'user'])->find($id);
        $userId = Auth::id();
        return view('user.question.show', compact('question', 'userId'));
    }

    public function showMyPage()
    {
        $questions = $this->question->with(['comment', 'tagCategory', 'user'])->where('user_id', Auth::id())->get();
        return view('user.question.mypage', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('user.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.index');
    }
}
