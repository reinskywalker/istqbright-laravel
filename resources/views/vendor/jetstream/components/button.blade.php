<button {{ $attributes->merge(['type' => 'submit', 'class' => 'appearance-none block w-full bg-blue-500 text-gray-100 font-bold border border-gray-700 rounded-lg py-3 px-3 leading-tight active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 ']) }}>
    {{ $slot }}
</button>