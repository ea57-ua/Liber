@extends('layouts.master')
@section('title', 'Liber - Movie List Details')
@section('content')

    <h1> List details </h1>
    <h1> {{$list->name}}</h1>
    <h1> {{$list->description}}</h1>
@endsection
