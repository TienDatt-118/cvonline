<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-gradient-to-r from-pink-500 to-purple-600 border border-transparent rounded-full font-bold text-xs text-white uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg transform hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
