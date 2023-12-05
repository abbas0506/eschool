@extends('layouts.library.assistant')
@section('page-content')
<div class="container">
    <h2>Issue Book</h2>
    <div class="bread-crumb">
        <a href="{{url('assistant')}}">Home</a>
        <div>/</div>
        <div>Issue Book</div>
        <div>/</div>
        <div>Warning</div>
    </div>
    <div class="h-96 flex justify-center items-center">
        <div class="w-full md:w-1/2 mx-auto">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <div class="flex h-16 px-5 md:px-0 md:h-24 items-center justify-center border rounded-sm">
                <h2 class="text-red-800">{{ $warning_message }} <a href="{{route('library.assistant.book-return.scan')}}" class="link ml-8">Go back</a></h2>
            </div>

        </div>
    </div>
</div>
@endsection