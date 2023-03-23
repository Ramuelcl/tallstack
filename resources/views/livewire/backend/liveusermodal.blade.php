<div class="hidden shadow-md max-w-xl inset-auto rounded-md border-4 border-slate-400 bg-gray-300 dark:bg-gray-600">
    <header class="bg-blue-300 dark:bg-blue-600 p-4 rounded-t-4">
        <h1 class="font-bold text-gray-100 dark:text-gray-900">Add Record</h1>
    </header>

    <div class="grid grid-cols-12 p-4">
        <aside class="mr-6 col-span-3 text-sm">
            <ul>
                <li><a href="#user-delete-modal">Llama al modal</a> </li>
                <li><a href="#confirmation">Modal de confirmación</a> </li>
                <li>Link 2</li>
            </ul>
        </aside>
        <main class="text-sm col-span-9">
            <p class="mb-6">Would you like to delete account?</p>
            <form id="delete-user-form" method="POST" action="/" x-data @submit.prevent="
            if(! confirmed) location.hash = '#user-delete-modal';
            ">
                @csrf
                <p>
                    <x-button class="bg-blue-400 hover:bg-blue-500">yes, delete</x-button>
                </p>
            </form>
        </main>

    </div>

    <footer class="flex justify-between bg-blue-300 dark:bg-blue-600 p-4 rounded-t-4">
        <h5 class="font-bold text-gray-100 dark:text-gray-900">My site</h5>
        <p>2023</p>
    </footer>
</div>