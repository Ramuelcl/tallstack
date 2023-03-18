@props(['name'])
<div x-data="{ show: false }" x-show="show" @hashchange.window="show = (location.hash === '#{{ $name }}');" style="display: none">
    <!-- {{-- modal --}} -->
    <div class="fixed inset-0 bg-gray-500 opacity-90"></div>

    <div class="bg-gray-50 shadow-md p-4 max-w-sm h-48 m-auto rounded-xl fixed inset-0">
        <div class="flex flex-col h-full justify-between">
            <header>
                @if (isset($title))
                <h3 class="font-bold text-lg">{{ $title }}</h3>
                @else
                <h3 class="font-bold text-lg">falta el título</h3>
                @endif
            </header>
            <main class="mb-4">
                @if (isset($body))
                {{ $body }}
                @else
                <p>falta el cuerpo</p>
                @endif
            </main>
            <footer class="block justify-between">
                {{ $footer }}
            </footer>
        </div>
    </div>
</div>
