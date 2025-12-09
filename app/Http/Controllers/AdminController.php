<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Exports\ContactExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Hospital;
use App\Models\vaccine;
use App\Models\appointment;
use App\Mail\ApprovalEmail;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
class AdminController extends Controller
{
    public function getcontacts(){
        $rec = Contact::get();
        return view('admin.users',compact('rec'));
    }

    public function deletedata($userid)
    {
        $user = Contact::find($userid);
        $user->delete();
        return redirect('/user');
    }
    public function getupdaterecord($userid){
        $user = Contact::find($userid);  
        return view('admin.updateuser',compact('user'));
    }
    public function edits(Request $req,$userid)
    {
       
        $req->contactemail;
        $req->contactsubject;
        $req->contactmessage;
        // $userid = $req->userid;
        $user = Contact::find($userid);
        $user->contactname =  $req->contactname;
        $user->contactemail =  $req->contactemail;
        $user->subject =  $req->contactsubject;
        $user->message =  $req->contactmessage;
        $user->save();
        return redirect('/user');
    }
    public function export() 
    {
        return Excel::download(new ContactExport, 'contactenquiries.xlsx');
    }

    public function download() {
    $pdf = Pdf::loadView('welcome');
 
    return $pdf->download();
}
public function getappointments()
{
    $rec = User::join('appointments','users.id','appointments.userid')->join('vaccines','vaccines.id','appointments.vaccineid')->join('hospitals','hospitals.id','vaccines.hospitalid')->get();
    return view('testappointments',compact('rec'));
   
}
public function getallusers()
{
    $user = User::where('role','User')->get();
    return view('admin.allusers',compact('user'));
}
public function updaterole($id)
{
    $user = User::find($id);
    $user->role = "Admin";
    $user->save();
    Mail::to($user->email)->send(new ApprovalEmail());
    return redirect()->back();
   
}
public function insertdata(Request $req)
{
    echo $req->post('uname');

}
public function getuserdata()
{
    $user = User::get();
    return response()->json($user);
}
public function addcategory(Request $req)
{
    $categoryname = $req->categoryname;
    $table = new Category();
    $table->categoryname = $categoryname;
    $table->save();
    return redirect()->back()->with('successmsg','Category has been added');
}
public function fetchcategory()
{
    $cat = Category::get();

    return view('admin.productupload',compact('cat'));
}
public function uploadproduct(Request $req)
{
    $table = new Product();
    $table->ProductName = $req->productname;

    $table->ProductDescription = $req->productdescription;
    $uploadDir = "products/";
    $file = $req->file('productimage');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('products'), $fileName);
    $table->ProductImage = $fileName;

    $table->ProductSKU = $req->productsku;
    $table->RegularPrice = $req->regularprice;
    $table->SaleStart = $req->salestartdate;
    $table->SaleEnd = $req->saleenddate;
    $table->SalePercentage = $req->salepercentage;
    $table->SalePrice = $req->regularprice - ($req->regularprice * $req->salepercentage / 100);
    $table->CategoryId = $req->categorylist;
    $table->save();

}
}
