<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Test Result Details') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl m-4 mx-auto sm:px-6 lg:px-8">


        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 border-2 shadow-lg overflow-hidden sm:rounded-lg">
            <!-- <div class="px-4 py-5 sm:px-6">
                <h1 class="text-sm leading-6 font-medium text-gray-900">
                    Test Details
                </h1>
                <p class="mt-1 max-w-2xl text-sm text-gray-700">

                    <span class="text-bold bg-green-100 px-2 rounded-lg">You took this quiz {{$userQuizDetails->updated_at->diffForHumans()}}</span>
                </p>
            </div> -->

            <div class="border-t border-gray-300">
                <dl>
                    <div class="bg-gray-50 px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-700">
                            Section Title
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$userQuizDetails->section->name}}
                            <p class="mt-1 max-w-2xl text-sm text-gray-700">
                                {{$userQuizDetails->section->description}}
                            </p>
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-700">
                            Test Count
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$userQuizDetails->quiz_size}}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-700">
                            Test Result
                        </dt>
                        @if($userQuizDetails->score < 70) <dd class="mt-1 px-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 rounded-lg">
                            {{$userQuizDetails->score .' %'}}
                            </dd>
                            @else
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 rounded-lg">
                                {{$userQuizDetails->score .' %'}}
                            </dd>
                            @endif
                    </div>
                    <!-- <div class="bg-white px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-700">
                            Quiz Duration
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$userQuizDetails->updated_at->diffInMinutes($userQuizDetails->created_at) .' Minutes'}}
                        </dd>
                    </div> -->
                </dl>
            </div>
        </div>

        @foreach($quizQuestions as $key => $question)
        @php
        $userAnswer = $userQuiz[$key];
        @endphp
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 mb-2 font-medium text-gray-900">
                    <span class="mr-2 font-bold"> {{$key + 1}} - </span>{{$question->question}}

                </h3>
                @foreach($question->answers as $key => $answer)
                <div class="mt-4 p-4 rounded-lg shadow-md @if(($userAnswer->is_correct === '1') && ($answer->is_checked === '1')) bg-green-100 @elseif(($userAnswer->answer_id === $answer->id) && ($answer->is_checked === '0')) bg-red-100 @elseif($answer->is_checked && $userAnswer->is_correct === '0') bg-green-100 @endif">
                    @if(($userAnswer->is_correct === '1') && ($answer->is_checked === '1'))
                    <span class="mr-2 font-extrabold">{{$choice->values()->get($key)}} </span> {{$answer->answer}} <span class="p-1 font-extrabold"> - <i>(Correct Answer)</i></span>
                    <span class="ml-2 text-green-500">&#10003;</span>
                    @elseif(($userAnswer->answer_id === $answer->id) && ($answer->is_checked === '0'))
                    <span class="mr-2 font-extrabold">{{$choice->values()->get($key)}} </span> {{$answer->answer}} <span class="p-1 font-extrabold"> - <i>(Correct Answer)</i></span>
                    <span class="ml-2 text-red-600">&#10005;</span>
                    @elseif($answer->is_checked && $userAnswer->is_correct === '0')
                    <span class="mr-2 font-extrabold">{{$choice->values()->get($key)}} </span> {{$answer->answer}} <span class="p-1 font-extrabold"> - <i>(Correct Answer)</i></span>
                    <span class="ml-2 text-green-500">&#10003;</span>
                    @else
                    <span class="mr-2 font-extrabold">{{$choice->values()->get($key)}} </span> {{$answer->answer}}
                    @endif
                </div>
                @endforeach


                <div x-data="{ show: true }" class="block text-xs">
                    <div class="p-1" id="headingOne">
                    </div>
                    <div x-show="show" class="mt-3 p-4 bg-green-100 text-md font-bold rounded-lg shadow-md">
                        {{$question->explanation}}
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
