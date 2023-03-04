<div class="hidden fixed top-0 bottom-0 bg-gray-500 h-screen w-8 md:w-16 lg:w-32 xl:w-64" x-data="{ isOpen:false }" id="sidebar-menu-1">
    <!-- CLASS: app/Http/Livewire//Sidebar.php -->
    <!-- VIEW: C:\laragon\www\esqueleto0\resources\views/livewire/sidebar.blade.php -->
    <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <i class="cursor-pointer fa-solid fa-close" x-on:click="open = false"></i>
            <h1 class="font-bold text-gray-200 text-[15px] ml-3">Sidebar</h1>
        </div>
        <hr class="my-2 text-gray-600">
    </div>

    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
        <i class="fa-solid fa-home"></i>
        <span class="text-[15px] ml-4 text-gray-200">Home</span>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
        <i class="fa-solid fa-music"></i><span class="text-[15px] ml-4 text-gray-200">uno</span>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
        <i class="fa-solid fa-heart"></i><span class="text-[15px] ml-4 text-gray-200">mas</span>
    </div>

    <hr class="my-2 text-gray-600">

    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-400 text-white">
        <i class="fa-solid fa-star"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200">chatbox</span>
            <span class="text-sm" id="arrow"><i class="fa-solid fa-chevron-down"></i> </span>
        </div>
    </div>
</div>
