@extends('layouts.assistant')
@section('page-content')

<div class="custom-container">
    <h1>{{$clas->roman()}}</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.classes.index')}}">Classes</a>
        <div>/</div>
        <div>{{$clas->roman()}}</div>
    </div>

    <!-- search -->
    <div class="flex items-center justify-between mt-12">
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
        <div class="flex flex-col justify-center items-center">
            <a href="{{route('library.assistant.qrcodes.students.preview',$clas)}}" target="_blank"><i class="bi bi-qr-code"></i></a>
            <label for="">Print QRCode</label>
        </div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="overflow-x-auto w-full mt-8">

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Father</th>
                    <th>BForm</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clas->students as $student)
                <tr class="tr text-sm">
                    <td>
                        <a href="{{route('admin.students.show', $student)}}" class="link">
                            {{$student->rollno}}
                        </a>
                    </td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->father}}</td>
                    <td>{{$student->cnic}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script type="text/javascript">
    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
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