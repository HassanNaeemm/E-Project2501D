@extends('layout')
@section('content')

<h1>Contact Page</h1>
<!-- @if(isset($abc))
    <h2>Hello, {{ $abc }}!</h2>
@endif -->

<hr>
@if(isset($success))
<p>{{$success}}</p>
@endif
<form action="/insertdata" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="username" placeholder="Enter your name">
    <br>
    <input type="email" name="email" placeholder="Enter your email">
    <br>
    <input type="subject" name="subject" placeholder="Enter subject">
    <br>
    <input type="file" name="myfile">
    <br>
    <textarea name="message" placeholder="Enter your message"></textarea>
    <br>
    <button type="submit">Submit</button>
</form>
@endsection