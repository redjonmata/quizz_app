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
        $questions = Question::with('answers')->where('test_id', $testId)->get()->toArray();
        $answers = $request->get('answers');
        $result = 0;

        foreach ($questions as $key => $question) {
            $correct = array_filter(
                $question['answers'],
                function ($ans) {
                    return $ans['is_correct'] == 'yes';
                }
            );
            if ($question['type'] == 'single') {
                if ($answers[$key][0] == $correct[0]['text']) {
                    $result++;
                }
            } elseif ($question['type'] == 'multiple') {
                if (count($answers[$key]) === count($correct)) {
                    if (array_diff(array_column($correct, 'text'), $answers[$key]) == []) {
                        $result++;
                    }
                }
            } else {
                if ($answers[$key][0] == $correct[0]['text']) {
                    $result++;
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
