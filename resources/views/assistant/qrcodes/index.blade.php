@extends('layouts.assistant')
@section('page-content')
<div class="container">
    <h2>QRCodes <i class="bi bi-qr-code"></i></h2>
    <div class="bread-crumb">
        <a href="{{url('assistant')}}">Home</a>
        <div>/</div>
        <div>QRCodes</div>
        <div>/</div>
        <div>index</div>
    </div>

    <div class="mt-12">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif


        <!-- Teachers -->

        <div class="flex items-center justify-between border p-4 rounded">
            <div class="flex items-center space-x-4">
                <i class="bx bx-user"></i>
                <h2>Teachers <span class="text-xs font-normal text-slate-600">({{$teachers->count()}})</span></h2>
            </div>

            <a href="{{route('library.assistant.qrcodes.teachers.preview')}}" target="_blank"><i class="bi bi-printer"></i></a>
        </div>

        <div class="rounded mt-6">
            <div class="flex items-center space-x-4 bg-teal-100 py-3 px-4">
                <i class="bx bx-book"></i>
                <h2>Book Racks <span class="text-xs font-normal text-slate-600">(choose a rack)</span></h2>
            </div>

            <div class="flex items-center flex-wrap gap-y-4 p-4 text-sm bg-teal-50 text-center">
                @foreach($book_racks as $book_rack)
                <a href="{{route('library.assistant.book_racks.show',$book_rack)}}" class="link w-16">{{$book_rack->label}} <span class="text-xs text-slate-600">({{$book_rack->books->count()}})</span></a>
                @endforeach
            </div>
        </div>

        <!-- classes -->
        <div class="rounded mt-6">
            <div class="flex items-center space-x-4 bg-pink-100 py-3 px-4">
                <i class="bx bx-group"></i>
                <h2>Students <span class="text-xs font-normal text-slate-600">(choose a rack)</span></h2>
            </div>
            <div class="flex flex-wrap gap-y-4 p-4 text-sm bg-pink-50 text-center">
                @foreach($classes as $clas)
                <a href="{{route('library.assistant.classes.show',$clas)}}" class="link w-16">{{$clas->grade->roman_name}}-{{$clas->section_label}} <span class="text-xs text-slate-600">({{$clas->students->count()}})</span></a>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }
</script>

@endsection