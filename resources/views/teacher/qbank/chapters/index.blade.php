@extends('layouts.teacher')
@section('page-content')

<div class="container">
    <h1>Create Question</h1>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <div>/</div>
        <a href="{{route('teacher.qbank.index')}}">Q.bank</a>
        <div>/</div>
        <a href="{{route('teacher.grades.subjects.index',$subject->grade)}}">{{$subject->grade->roman_name}}</a>
        <div>/</div>
        <div>{{$subject->name}}</div>
        <div>/</div>
        <div>Chapters</div>

    </div>
    <div class="md:w-3/4 mx-auto mt-24">

        <label for="">{{$subject->grade->roman_name}}</label>
        <h2>{{$subject->name}}</h2>
        <div class="divider my-3"></div>
        <div class="w-full">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif
        </div>

        @if($subject->chapters->count()>0)
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3 place-content-center">

            @foreach($subject->chapters->sortBy('chapter_no') as $chapter)
            <div class="flex justify-between items-center p-3 bg-sky-100 hover:bg-sky-300">
                <a href="{{route('teacher.subjects.chapters.show', [$subject, $chapter])}}" class="flex-1">{{$chapter->chapter_no}}. {{$chapter->name}}</a>
                @if($chapter->questions->count()>0)
                <a href="{{route('teacher.subjects.chapters.edit', [$subject, $chapter])}}" class=""><i class="bx bx-pencil">e</i></a>
                @else
                <form action="{{route('teacher.subjects.chapters.destroy',[$subject, $chapter])}}" method="post" class="flex justify-center items-center rounded-full w-6 h-6 bg-orange-50" onsubmit="return confirmDel(event)">
                    @csrf
                    @method('DELETE')
                    <button><i class="bi-x text-red-600"></i>x</button>
                </form>
                @endif
            </div>
            @endforeach
            <a href="{{route('teacher.subjects.chapters.create',$subject)}}" class="flex justify-start items-center p-3 border border-sky-200 hover:bg-sky-300">New Chapter +</a>
        </div>
        @else
        <div class="grid place-content-center h-32 text-center">
            <p class="text-slate-500">Currently no chapter found</p>
            <a href="{{route('teacher.subjects.chapters.create',$subject)}}" class="link"><i class="bi-plus-circle"></i>Click here to start</a>

        </div>
        @endif

    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }
</script>
@endsection