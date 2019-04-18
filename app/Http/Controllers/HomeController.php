<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tests = Test::with('questions')->where('public', 'yes')->where('published', 'yes')->get();

        return view('home')->with(compact('tests'));
    }

    public function takeTest($testId)
    {
        $test = Test::where('id', $testId)->first();
        $questions = Question::with('answers')->where('test_id', $testId)->get();

        return view('test')->with(compact('test', 'questions'));
    }

    public function submitTest(Request $request, $testId)
    {
        $questions = Question::with('answers')->where('test_id', $testId)->get();
        $result = 0;

        foreach ($questions as $question) {
            if($question->type == 'Single' || $question->type == 'Multiple') {
                foreach ($question->answers as $answer) {
                    if ($request->input($answer->text) == 'on' && $answer->is_correct == 'yes') {
                        $result++;
                    }
                }
            } else if($question->type == 'Multiple') {
                foreach ($question->answers as $answer) {
                    if ($request->input($answer->text) == 'on' && $answer->is_correct == 'yes') {
                        $result++;
                        break;
                    }
                }
            } else {
                foreach ($question->answers as $answer) {
                    for ($x = 1; $x <= $request->input('explination_number'); $x++) {
                        if ($request->input('answer_' . $x) == $answer->text) {
                            $result++;
                        }
                    }
                }
            }
        }

        DB::table('user_test')->insert([
            'user_id' => Auth::id(),
            'result' => $result,
            'test_id' => $testId
        ]);

    }
}
