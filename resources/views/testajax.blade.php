@extends('layout')
@section('content')
<input type="text" id="username" placeholder="Enter username">
<br>
<button onclick="senddata()">Send Data</button>
<button onclick="getdata()">Get Data</button>
<script>
    function senddata()
    {
        var username = document.getElementById('username').value
        $.ajax({
            url:"/insdata",
            type:"post",
            data:{
                "uname":username,
                "_token":"{{ csrf_token() }}"
            },
            success:function(){
                console.log(username)
            }
        })
    }
    function getdata()
    {
        $.ajax({
            url:"/getdata",
            type:"get",
            success:function(user){
                console.log(user)
            }
        })
    }
</script>
@endsection