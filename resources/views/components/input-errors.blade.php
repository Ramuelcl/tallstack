@props(['idName' => ''])
@if($errors->has($idName))
<small class="text-red-600">{{$errors->first($idName)}}</small>
@endif