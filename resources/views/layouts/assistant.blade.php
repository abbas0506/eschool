@extends('layouts.basic')

@section('header')
<x-auth.header></x-auth.header>
@endsection

@section('sidebar')
<x-assistant.sidebar></x-assistant.sidebar>
@endsection

@section('body')

<div class="responsive-body">
    @yield('page-content')
</div>

<script type="module">
    $('#toggle-current-user-dropdown').click(function() {
        $("#current-user-dropdown").toggle();
    });
    $('#menu').click(function() {
        $("#sidebar").toggle();
    });
    $('#cboSemesterId').change(function() {
        $('#switchSemesterForm').submit();
    });
</script>
@endsection