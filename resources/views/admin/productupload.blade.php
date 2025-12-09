@extends('admin.adminlayout')
@section('admincontent')
<div class="container">
    <form action="/insertproduct" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control" placeholder="Product Name" name="productname">
        <br>
        
        <textarea class="form-control" name="productdescription" id=""></textarea>
        <br>
        <p>Choose product Image</p>
        <input type="file" class="form-control" name="productimage">
        <br>
        <input type="number" class="form-control" name="productsku" placeholder="Enter Product SKU">
        <br>
        <input type="number" class="form-control" name="regularprice" placeholder="Regular Price">
        <br>
        <p>Sale Start Date</p>
        <input type="date" class="form-control" name="salestartdate">
        <br>
        <p>Sale End Date</p>
        <input type="date" class="form-control" name="saleenddate">
        <p>Enter Sale Percentage</p>
        <input type="number" name="salepercentage" class="form-control" >
        <br>
        <p>Select Category</p>
        <select name="categorylist" class="form-control" id="">
            <option value="" disabled>Select Category</option>
            @foreach($cat as $c)
            <option value="{{$c->id}}">{{$c->categoryname}}</option>
            @endforeach
        </select>
        <button type="submit">Upload Product</button>
    </form>
</div>
@endsection