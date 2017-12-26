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

@section('jss')
    {!! $jss !!}
@endsection

@section('footer')
    {!! $footer !!}
@endsection
