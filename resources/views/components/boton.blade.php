<div class="flex justify-center space-x-2">
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'min-w-lg mx-2 capitalized inline-block rounded px-6 pt-2.5 pb-2 text-xs font-medium leading-normal dark:bg-gray-900 dark:text-gray-50 shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]']) }}>
        {{ $slot }}
    </button>
</div>