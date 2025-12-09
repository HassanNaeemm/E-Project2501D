@extends('admin.adminlayout')
@section('admincontent')
<div class="container">
    @if(session('successmsg'))
    <p>Category Added</p>
    @endif
    <form action="/addcategory" method="post">
        @csrf
        <input type="text" name="categoryname">
        <br>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
</div>
@endsection