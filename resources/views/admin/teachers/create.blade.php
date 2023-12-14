@extends('layouts.admin')
@section('page-content')
<div class="container">
    <h2>New Teacher</h2>
    <div class="bread-crumb">
        <a href="{{url('assistant')}}">Home</a>
        <div>/</div>
        <a href="{{route('admin.teachers.index')}}">Teachers</a>
        <div>/</div>
        <div>New</div>
    </div>

    <div class="w-full md:w-4/5 mx-auto mt-12">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('admin.teachers.store')}}" method='post' class="mt-4" onsubmit="return validate(event)">
            @csrf
            <div class="grid grid-cols-4 gap-x-4 gap-y-1">
                <div class="md:col-span-2">
                    <label>Name *</label>
                    <input type="text" name='name' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="md:col-span-2">
                    <label>Father *</label>
                    <input type="text" name='father' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Birth Date *</label>
                    <input type="date" name='dob' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>CNIC *</label>
                    <input type="text" name='cnic' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Phone *</label>
                    <input type="text" name='phone' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Email *</label>
                    <input type="text" name='email' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="md:col-span-2">
                    <label>Address</label>
                    <input type="text" name='address' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Qualification</label>
                    <input type="text" name='qualification' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Designation *</label>
                    <input type="text" name='designation' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>BPS *</label>
                    <input type="number" name='bps' class="custom-input" placeholder="Type here" value="16">
                </div>
                <div class="">
                    <label>Personal # *</label>
                    <input type="text" name='personal_no' class="custom-input" placeholder="Type here" value="">
                </div>

                <div class="">
                    <label>Appointed On</label>
                    <input type="date" name='appointed_on' class="custom-input" placeholder="Type here" value="">
                </div>
                <div class="">
                    <label>Joined On (this school)</label>
                    <input type="date" name='joined_on' class="custom-input" placeholder="Type here" value="">
                </div>

                <div class="flex mt-4">
                    <button type="submit" class="btn-teal rounded p-2">Create Now</button>
                </div>
        </form>

    </div>
</div>
@endsection