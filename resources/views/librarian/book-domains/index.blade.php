@extends('layouts.librarian')
@section('page-content')
<div class="container">
    <h2>Book Domains</h2>
    <div class="bread-crumb">
        <a href="{{url('librarian')}}">Home</a>
        <div>/</div>
        <div>Book Domains</div>
        <div>/</div>
        <div>All</div>
    </div>

    <div class="mt-8">

        <!-- search -->
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="search-indigo w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif
        <div class="flex flex-row items-center justify-between mt-8">
            <div class="text-gray-400">({{ $bookDomains->count() }}) records found</div>

            <a href="{{route('librarian.book-domains.create')}}" class="btn-teal rounded-sm">New</a>

        </div>
        @php $sr=1; @endphp
        <div class="overflow-x-auto w-full mt-2">
            <table class="table-fixed w-full">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="w-12">Sr</th>
                        <th class="w-40">Name</th>
                        <th class="w-16">Books</th>
                        <th class="w-24">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach($bookDomains->sortByDesc('updated_at') as $bookDomain)
                    <tr class="tr">

                        <td>{{$sr++}}</td>
                        <td class="text-left">
                            <a href="{{route('librarian.book-domains.show', $bookDomain)}}" class="link">{{$bookDomain->name}}</a>
                        </td>
                        <td>{{$bookDomain->books->count()}}</td>
                        <td>
                            <div class="flex items-center justify-center">
                                <a href="{{route('librarian.book-domains.edit',$bookDomain)}}"><i class="bx bx-pencil text-green-600"></i></a>
                                <span class="text-slate-300 px-2">|</span>
                                <form action="{{route('librarian.book-domains.destroy',$bookDomain)}}" method="post" onsubmit="return confirmDel(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button><i class="bx bx-trash text-red-600"></i></button>
                                </form>
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
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