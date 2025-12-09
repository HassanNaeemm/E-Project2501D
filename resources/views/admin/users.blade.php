@extends('admin.adminlayout')
@section('admincontent')
<h1>Users Management Page</h1>
<hr>

<div class="container">
  <div class="d-flex">
      <a href="contacts/export/" class=" btn btn-success mx-2">Download all records</a>
    <a href="contacts/pdf" class="btn btn-success mx-2">Download in PDF</a>
  </div>
  <br>

    <div class="row">
        @foreach($rec as $r)
        <!-- <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <b>{{$r->contactname}}</b>
                </div>
                <div class="card-body">
                    <p>{{$r->subject}}</p>
                    <hr>
                    <p>{{$r->message}}</p>
                </div>
                <div class="card-footerr"></div>
            </div>
        </div> -->
       
                <div class="col-3">
                    <p>{{$r->contactname}}</p>
                </div>
                <div class="col-3">
                     <p>{{$r->subject}}</p>
                </div>
                <div class="col-3">
                   <a href="uploads/{{$r->userfile}}">View File</a>
                </div>
                   <div class="col-3">
                  <div class="d-flex">
                      <form action="/delete/{{$r->id}}" method="post">
                         @csrf
                         <button type="submit" class="btn btn-danger mx-2">Delete</button>
                    </form>
                     <form action="/updateuser/{{$r->id}}" method="post">
                         @csrf
                         <button type="submit" class="btn btn-primary mx-2">Update User</button>
                    </form>
                  </div>
                </div>
        @endforeach
    </div>
</div>


@endsection