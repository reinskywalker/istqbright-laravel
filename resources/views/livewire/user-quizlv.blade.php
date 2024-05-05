<div class="bg-white rounded-lg shadow-lg p-5 mt-10 md:p-20 mx-2">

    @if($quizInProgress)
    <div class="px-4 -py-3 sm:px-6">
        <div class="flex max-w-auto justify-between">
        </div>
    </div>

    <div class="flex justify-end">
        <div class="flex">
            <p class="mt-1 max-w-2xl text-sm text-gray-500 text-center">
                <span class="font-bold p-2 leading-loose bg-blue-500 text-white rounded-md">{{$count .' / '. $testSize}}</span>
            </p>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-3">

        <form wire:submit.prevent>
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 mb-2 font-medium text-gray-900">
                    <span class="mr-2 font-extrabold"> {{$count}}</span> {{$currentQuestion->question}}
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($currentQuestion->answers as $answer)
                    <label for="question-{{$answer->id}}">
                        <div class="flex flex-col h-full max-w-full">
                            <div class="flex-1 max-w-full p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 border border-gray-300">
                                <span class="mr-2 font-extrabold"><input id="question-{{$answer->id}}" value="{{$answer->id .','.$answer->is_checked}}" wire:model="userAnswered" type="checkbox"></span>
                                {{$answer->answer}}
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between px-4">
                <div class="flex items-center justify-start mt-4">
                    <button wire:click="previousQuestion" type="submit" @if($count < 2 || $isDisabled) disabled='disabled' @endif class="m-4 p-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-blue-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        {{ __('Previous') }}
                    </button>
                </div>


                <div class="flex items-center justify-end mt-4">
                    @if($count < $testSize) <button wire:click="nextQuestion" type="submit" @if($isDisabled) disabled='disabled' @endif class="m-4 p-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-blue-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        {{ __('Next') }}
                        </button>
                        @else
                        <button wire:click="nextQuestion" type="submit" @if($isDisabled) disabled='disabled' @endif class="m-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            {{ __('Show Results') }}
                        </button>
                        @endif
                </div>
            </div>
        </form>
    </div>
    @endif


    <P>

    </P>
    @if($showResult)
    <section class="text-gray-600 body-font">
        <div class="bg-white border-2 border-gray-300 shadow overflow-hidden sm:rounded-lg">
            <div class="container px-5 py-5 mx-auto">
                <div class="text-center mb-5 justify-center">
                    <h1 class=" sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">Quiz Result</h1>
                    <p class="text-md mt-10"> Dear <span class="font-extrabold text-blue-600 mr-2"> {{Auth::user()->name.'!'}} </span> You have secured <a class="bg-green-300 px-2 mx-2 hover:green-400 rounded-lg underline" href="{{route('userQuizDetails',$quizid) }}">Show quiz details</a></p>
                    <progress class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto" id="quiz-{{$quizid}}" value="{{$quizPecentage}}" max="100"> {{$quizPecentage}} </progress> <span> {{$quizPecentage}}% </span>
                </div>
                <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
                    <div class="p-2 sm:w-1/2 w-full">
                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                            <svg fill=" none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <span class="title-font font-medium mr-5 text-purple-700">Correct Answers</span><span class="title-font font-medium">{{$currectQuizAnswers}}</span>
                        </div>
                    </div>
                    <div class="p-2 sm:w-1/2 w-full">
                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <span class="title-font font-medium mr-5 text-purple-700">Total Questions</span><span class="title-font font-medium">{{$totalQuizQuestions}}</span>
                        </div>
                    </div>
                    <div class="p-2 sm:w-1/2 w-full">
                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <span class="title-font font-medium mr-5 text-purple-700">Percentage Scored</span><span class="title-font font-medium">{{$quizPecentage.'%'}}</span>
                        </div>
                    </div>
                    <div class="p-2 sm:w-1/2 w-full">
                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <span class="title-font font-medium mr-5 text-purple-700">Quiz Status</span><span class="title-font font-medium">{{ $quizPecentage > 70 ? 'Pass' : 'Fail' }}</span>
                        </div>
                    </div>
                </div>
                <div class="mx-auto min-w-full p-2 md:flex m-2 justify-between">
                    <a href="{{route('userQuizDetails',$quizid) }}" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See Quizzes Details</a>
                    <a href="{{route('userHome')}}" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See All Your Quizzes</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($setupQuiz)
    <section class="text-gray-600 mx-auto body-font">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-wrap -m-4">

                <div class="p-4 md:w-2/2 w-full">
                    <form wire:submit.prevent="beginTest">
                        @csrf
                        <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Challenge Yourself</h2>




                        <div class="relative mx-full mb-4">
                            <select name="section" id="section_id" wire:model="sectionId" class="block w-full mt-1 rounded-md bg-gray-200 border-2 bg-gray-600 focus:bg-white focus:ring-0">
                                @if($sections->isEmpty())
                                <option value="">No Quiz Sections Available Yet</option>
                                @else
                                <option class="text-gray-900">Select Module</option>
                                @foreach($sections as $section)
                                @if($section->questions_count>0)
                                <option value="{{$section->id}}">{{$section->name}}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                            @error('sectionId') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input wire:model="isLearning" id="isLearning" name="isLearning" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm mb-4">
                                <label for="isLearning" class="font-medium text-gray-700">Exam Mode?</label>
                                <p class="text-gray-500">As ASTQB does, we will give you a time limit of 60 minutes</p>
                            </div>
                        </div>



                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input wire:model="isNonNative" id="isNonNative" name="isNonNative" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" @if(!$isLearning) disabled style="opacity: 0.5; cursor: not-allowed;" @endif>
                            </div>
                            <div class="ml-3 text-sm mb-4" @if(!$isLearning) style="background-color: #eee;" @endif>
                                <label for="isNonNative" class="font-medium text-gray-700">Non-Native Mode?</label>
                                <p class="text-gray-500">If you are not a native English speaker, as the test will be delivered in English, we will give you an extra time limit of 25%, therefore, the limit will be increased to 75 minutes</p>
                            </div>
                        </div>

                        <button type="submit" class="block w-full rounded-lg text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">Begin Test</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
