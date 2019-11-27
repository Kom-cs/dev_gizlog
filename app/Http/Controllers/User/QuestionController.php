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
        $input = $request->only(['search_word', 'tag_category_id']);
        $input->validate([
            'search_word' => 'nullable|string|exists:questions,title',
            'tag_category_id' => 'nullable|int|exists:questions',
            ]);
        $questions = $this->question->getFilterdQuestions($input);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->create($input);
        return redirect()->route('question.index');
    }

    public function showConfirm(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $question = $this->question->create($input);
        return view('user.question.confirm', 'question');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, User $user)
    {
        $question = Question::with(['comment', 'tagCategory', 'user'])->find($id);
        $userId = Auth::id();
        return view('user.question.show', compact('question', 'userId'));
    }

    public function showMyPage()
    {
        $questions = Question::with(['comment', 'tagCategory', 'user'])->where('user_id', Auth::id())->get();
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
        //
    }
}
