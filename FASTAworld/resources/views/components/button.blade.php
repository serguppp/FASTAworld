<button {{ $attributes->merge(['class' => 'flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm focus:outline-none focus:ring-2']) }}>
    {{ $slot }}
</button>