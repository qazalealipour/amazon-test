@extends('emails.layouts.app')

@section('content')
    <h2>{{ $details['title'] }}</h2>
    <p>{{ $details['body'] }}</p>
@endsection