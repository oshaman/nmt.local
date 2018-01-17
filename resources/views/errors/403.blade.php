@extends('layouts.main')

@section('header')
    {!! $header ?? ''!!}
@endsection

@section('content')
    <div class="container">
        <div class="oops-page-content">
            <strong class="simple-text">Вибачте, у Вас не достатньо прав для перегляду.</strong>
            <strong class="text-404">403</strong>
            <img class="img-404" src="{{ asset('/') }}img/oops-page-bckgrnd.jpg" alt="">
        </div>
    </div>
    <div class="container">
    </div>
@endsection

@section('footer')
    {!! $footer ?? ''!!}
@endsection