@extends('layouts.main')

@section('header')
    {!! $header !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('poll')
    {!! $poll ?? ''!!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection

@section('jss')
    {!! $jss !!}
@endsection