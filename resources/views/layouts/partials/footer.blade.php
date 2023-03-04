<!-- <footer class="pt-5 my-5 text-muted bg-cyan-600"> -->
<footer class="p-2 rounded-lg shadow md:flex md:items-center md:justify-between md:p-6 ">
    <span class="text-sm sm:text-center">&copy; {{ date('Y') }} &middot; <a href="mailto:ramuelcl@gmail.com" class="hover:underline">{{ __(' Created by ')}}</a> Ramuel Gonzalez
    </span>
    <ul class="flex flex-wrap items-center text-sm sm:mt-0">
        <li>
            <a href="{{ route('pages.about')}}" class="mr-4 hover:underline md:mr-6 ">{{ __('About')}}</a>
        </li>

        <li>
            <a href="{{route('pages.contact')}}" class="hover:underline">{{ __('Contact')}}</a>
        </li>
    </ul>
</footer>