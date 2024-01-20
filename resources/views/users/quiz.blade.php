<x-app-layout>
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // leading zero
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            document.getElementById("clock").innerHTML = hours + ":" + minutes + ":" + seconds;

            setTimeout(updateClock, 1000);
        }
        document.addEventListener("DOMContentLoaded", function() {
            updateClock();
        });
    </script>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>


            <div id="clock" class="text-right text-3xl font-bold text-gray-800">
                -:-:-
            </div>



        </div>


    </x-slot>
    <div class="max-w-7xl m-1 mx-auto sm:px-6 lg:px-8">
        <livewire:user-quizlv />
    </div>
</x-app-layout>