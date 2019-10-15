<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('homepage');
    }
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('registration');
    }
     public function insert(Request $request) {
      $name = $request->input('name');
      $email = $request->input('email');
      $pass = $request->input('password');
      $cpass = $request->input('cpassword');
      $data=array('name'=>$name,"email"=>$email,"password"=>$pass,"cpassword"=>$cpass);
      DB::table('register')->insert($data);
      //DB::insert('insert into register (name),(email),(password),(cpassword) values(?)',[$name],[$email],[$pass],[$cpass]);
      echo "Record inserted successfully.<br/>";
      echo '<a href = "/insert">Click Here</a> to go back.';
   }
   public function view()
   {
$users = DB::select('select * from register');
      return view('view',['users'=>$users]);
   }
}
