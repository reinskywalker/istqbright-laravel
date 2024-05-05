<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Section;
use App\Models\Question;
use App\Models\QuizHeader;

class userController extends Controller
{
    public function beginTest()
    {
        return view('users.quiz');
    }

    public function userHome()
    {
        $activeUsers = User::count();

        $questionsCount = Question::where('is_active', '1')->count();

        $sections = Section::withCount('questions')
            ->where('is_active', '1')
            ->orderBy('name')
            ->get();

        $quizesTaken = QuizHeader::count();

        $userQuizzes = auth()
            ->user()
            ->quizHeaders()
            ->orderBy('id', 'desc')
            ->paginate(10);

        $quizAverage = auth()->user()->quizHeaders()->avg('score');

        return view(
            'users.userHome',
            compact(
                'sections',
                'activeUsers',
                'questionsCount',
                'quizesTaken',
                'userQuizzes',
                'quizAverage'
            )
        );
    }


    public function deleteUserTest($id)
    {
        $quizheader = QuizHeader::findOrFail($id);
        if (auth()->id() == $quizheader->user_id) {
            $quizheader->delete();
            return redirect()->back()
                ->withSuccess("Quiz deleted successfully!");
        }
        return redirect()->back()->withWarning("Can not delete quiz!");
    }
    public function userQuizDetails($id)
    {
        $choice = collect(['A', 'B', 'C', 'D']);

        $userQuizDetails = QuizHeader::where('id', $id)
            ->with('section')->first();

        $quizQuestionsList = collect(unserialize($userQuizDetails->questions_taken));

        $userQuiz = Quiz::where('quiz_header_id', $userQuizDetails->id)
            ->orderBy('question_id', 'ASC')->get();
        $quizQuestions = Question::whereIn('id', $quizQuestionsList)->orderBy('id', 'ASC')->with('answers')->get();

        return view(
            'users.userQuizDetail',
            compact(
                'userQuizDetails',
                'quizQuestionsList',
                'userQuiz',
                'quizQuestions',
                'choice'
            )
        );
    }
}
