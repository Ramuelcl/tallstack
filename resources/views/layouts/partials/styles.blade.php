<!-- Fonts -->
<!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Styles -->
<!-- @vite('resources/css/app.css') -->
@vite(['resources/css/app.css','resources/js/app.js'])
<!-- Alternatively, you can also include the JavaScript file using CDN: -->
<!-- en vez de usar "import 'flowbite';" en archivo resources/js/app.js -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script> -->

<!-- FontAwesome 6.2.1 -->
<!-- <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}"> -->
<link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
<!-- <link href="{{asset('assets/fontawesome/css/fontawesome.css')}}" rel="stylesheet">
<link href="{{asset('assets/fontawesome/css/brands.css')}}" rel="stylesheet">
<link href="{{asset('assets/fontawesome/css/solid.css')}}" rel="stylesheet"> -->

<!-- Bootstrap core CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
@livewireStyles
