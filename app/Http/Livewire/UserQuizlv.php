<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use App\Models\Quote;
use App\Models\Section;
use Livewire\Component;
use App\Models\Question;
use App\Models\QuizHeader;

class UserQuizlv extends Component
{
    public $quote;
    public $quizid;
    public $sections;
    public $count = 0;
    public $sectionId;
    public $testSize = 5;
    public $quizPecentage;
    public $currentQuestion;
    public $setupQuiz = true;
    public $userAnswered = [];
    public $isDisabled = true;
    public $currectQuizAnswers;
    public $showResult = false;
    public $totalQuizQuestions;
    public $isLearning = false;
    public $isNonNative = false;
    public $quizInProgress = false;
    public $answeredQuestions = [];

    protected $rules = [
        'sectionId' => 'required',
        'testSize' => 'required|numeric',
    ];


    public function showResults()
    {
        $this->totalQuizQuestions = Quiz::where('quiz_header_id', $this->quizid->id)->count();

        $this->currectQuizAnswers = Quiz::where('quiz_header_id', $this->quizid->id)
            ->where('is_correct', '1')
            ->count();

        $this->quizPecentage = round(($this->currectQuizAnswers / $this->totalQuizQuestions) * 100, 2);

        $this->quizid->questions_taken = serialize($this->answeredQuestions);

        $this->quizid->completed = true;

        $this->quizid->score = $this->quizPecentage;

        $this->quizid->save();

        $this->quizInProgress = false;
        $this->showResult = true;
    }

    public function updatedIsLearning()
    {
        if (!$this->isLearning) {
            $this->isNonNative = false;
        }
    }

    public function render()
    {
        $this->sections = Section::withcount('questions')->where('is_active', '1')
            ->orderBy('name')
            ->get();

        return view('livewire.user-quizlv');
    }

    public function updatedUserAnswered()
    {
        if ((empty($this->userAnswered) || (count($this->userAnswered) > 1))) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function mount()
    {
        $this->quote = Quote::inRandomOrder()->first();
    }

    public function getNextQuestion()
    {
        // randomize test, still bug
        $question = Question::where('section_id', $this->sectionId)
            ->whereNotIn('id', $this->answeredQuestions)
            ->with(['answers' => function ($query) {
                $query->inRandomOrder();
            }])
            ->inRandomOrder()
            ->first();


        $question = Question::where('section_id', $this->sectionId)
            ->whereNotIn('id', $this->answeredQuestions)
            ->with('answers')
            ->inRandomOrder()
            ->first();

        if ($question === null) {
            $this->quizid->quiz_size = $this->count - 1;
            $this->quizid->save();
            return $this->showResults();
        }
        array_push($this->answeredQuestions, $question->id);
        return $question;
    }

    public function beginTest()
    {

        $this->validate();
        $this->quizid = QuizHeader::create([
            'user_id' => auth()->id(),
            'quiz_size' => $this->testSize,
            'section_id' => $this->sectionId,
        ]);
        $this->count = 1;
        $this->currentQuestion = $this->getNextQuestion();
        $this->setupQuiz = false;
        $this->quizInProgress = true;
    }

    public function nextQuestion()
    {
        $this->quizid->questions_taken = serialize($this->answeredQuestions);
        list($answerId, $isChoiceCorrect) = explode(',', $this->userAnswered[0]);

        Quiz::create([
            'user_id' => auth()->id(),
            'quiz_header_id' => $this->quizid->id,
            'section_id' => $this->currentQuestion->section_id,
            'question_id' => $this->currentQuestion->id,
            'answer_id' => $answerId,
            'is_correct' => $isChoiceCorrect
        ]);

        $this->quizid->save();

        $this->count++;

        $answerId = '';
        $isChoiceCorrect = '';
        $this->reset('userAnswered');
        $this->isDisabled = true;

        if ($this->count == $this->testSize + 1) {
            $this->showResults();
        }

        // random test
        $this->currentQuestion = $this->getNextQuestion();
    }
}
