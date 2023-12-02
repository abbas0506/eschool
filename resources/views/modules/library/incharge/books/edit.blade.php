@extends('layouts.library.incharge')
@section('page-content')
<div class="container">
    <h2>Edit Book</h2>
    <div class="bread-crumb">
        <a href="{{url('library/incharge')}}">Home</a>
        <div>/</div>
        <a href="{{route('library.incharge.books.index')}}">Books</a>
        <div>/</div>
        <div>Edit</div>
    </div>

    <div class="w-full md:w-3/4 mx-auto mt-8">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('library.incharge.books.update', $book)}}" method='post' class="mt-4" onsubmit="return validate(event)">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-1">
                <div class="col-span-2 md:col-span-3">
                    <label>Book Title *</label>
                    <input type="text" name='title' class="custom-input" placeholder="Type here" value="{{$book->title}}">
                </div>
                <div class="col-span-2 md:col-span-3">
                    <label>Author *</label>
                    <input type="text" name='author' class="custom-input" placeholder="Type here" value="{{$book->author}}">
                </div>

                <div class="col-span-3" hidden>
                    <label>Introduction</label>
                    <textarea name='introduction' class="custom-input" placeholder="Type here" rows="2">{{$book->introduction}}</textarea>
                </div>
                <div>
                    <label>Publish Year</label>
                    <input type="number" name='publish_year' class="custom-input" placeholder="Type here" value="{{$book->publish_year}}" min="1800" max="{{date('Y')}}">
                </div>
                <div>
                    <label>How Many Copies? *</label>
                    <input type="number" name='num_of_copies' class="custom-input" placeholder="Type here" value="{{$book->num_of_copies}}" min="1" max="50">
                </div>
                <div>
                    <label>Unit Price *</label>
                    <input type="number" name='price' class="custom-input" placeholder="Type here" value="{{$book->price}}" min="0" max="100000">
                </div>
                <div>
                    <label>Language *</label>
                    <select name="language_id" id="" class="custom-input">
                        @foreach($languages as $language)
                        <option value="{{$language->id}}" @selected($book->language_id==$language->id)>{{$language->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Book Domain *</label>
                    <select name="book_domain_id" id="" class="custom-input">
                        <option value="">Select --</option>
                        @foreach($book_domains as $book_domain)
                        <option value="{{$book_domain->id}}" @selected($book->book_domain_id==$book_domain->id)>{{$book_domain->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Book Rack *</label>
                    <select name="book_rack_id" id="" class="custom-input">
                        <option value="">Select --</option>
                        @foreach($book_racks as $book_rack)
                        <option value="{{$book_rack->id}}" @selected($book->book_rack_id==$book_rack->id)>{{$book_rack->label}}</option>
                        @endforeach
                    </select>


                </div>
                <div class="flex mt-4">
                    <button type="submit" class="btn-teal rounded p-2">Update Now</button>
                </div>
        </form>

    </div>
</div>
@endsection