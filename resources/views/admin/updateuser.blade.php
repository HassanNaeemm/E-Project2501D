
<div class="container">
    <form action="/updaterecord/{{$user->id}}" method="post">
        @csrf
         <!-- <input type="hidden" name="userid" value="{{$user->id}}"> -->
        <br>
        <input type="text" value="{{$user->contactname}}" name="contactname">
        <br>
          <input type="text" value="{{$user->contactemail}}" name="contactemail">
        <br>
          <input type="text" value="{{$user->subject}}" name="contactsubject">
        <br>
          <input type="text" value="{{$user->message}}" name="contactmessage">
        <br>
        <button type="submit">Update User</button>

    </form>
</div>
