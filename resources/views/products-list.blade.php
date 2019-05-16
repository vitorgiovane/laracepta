@extends('layouts.app')
<!-- @import('includes.nav') -->

@section('sidebar')
@component('sidebar')
@endsection

@section('content')
@include('includes.card')
@endsection
