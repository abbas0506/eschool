@extends('layouts.admin')
@section('page-content')
<div class="container">
    <h2>New Chapter</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <div>/</div>
        <a href="{{route('teacher.grades.show',$subject->grade_id)}}">{{$subject->grade->roman_name}}</a>
        <div>/</div>
        <a href="{{route('teacher.subjects.show',$subject)}}">{{$subject->name}}</a>
        <div>/</div>
        <div>New Chapter</div>
    </div>

    <div class="flex h-80 justify-center items-center w-full md:w-1/2 mx-auto">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif
        <form action="{{route('teacher.chapters.store')}}" method='post' class="w-full" onsubmit="return validate(event)">
            @csrf
            <input type="hidden" name='subject_id' value="{{$subject->id}}">
            <div class="flex flex-col">
                <label class="">Ch #</label>
                <input type="number" name='chapter_no' class="custom-input w-20" value="{{$chapterNo}}" min=1>
            </div>
            <div class="flex flex-col mt-1">
                <label class="">Title</label>
                <input type="text" name='name' class="custom-input py-2" placeholder="Chapter title" value="">
            </div>
            <div class="mt-4">
                <button type="submmit" class="btn-teal rounded px-4 py-2">Create</button>
            </div>
        </form>

    </div>
</div>
@endsection