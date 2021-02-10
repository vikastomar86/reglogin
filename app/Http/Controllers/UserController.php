<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use JWTFactory;
class UserController extends Controller
{
    //
	
	public function register(Request $request)
    {
		//Request $request;
		//echo 1;
		//print_r($request);
		//exit;
		$form_data = json_decode(file_get_contents("php://input"));
		//print_r($form_data );exit;
		
$message = '';
$validation_error = '';

if(empty($form_data->first_name))
{
 $error[] = 'First name is Required';
}

if(empty($form_data->last_name))
{
 $error[] = 'Last name is Required';
}

if(empty($form_data->email))
{
 $error[] = 'Email is Required';
}
else
{
 if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
 {
  $error[] = 'Invalid Email Format';
 }
 
}

if(empty($form_data->password))
{
 $error[] = 'Password is Required';
}
if(!empty($form_data->password) && !empty($form_data->password_confirmation)){
if($form_data->password!= $form_data->password_confirmation )
{
	$error[] = 'Password and confirm password does not match';
}

}
if(empty($error))
{
 $password = Hash::make($form_data->password);
 $id= DB::table('users')->insert([
    'first_name' => $form_data->first_name,
    'last_name' => $form_data->last_name,
	'email' => $form_data->email,
	'password' => $password,
	'country' => $form_data->country,
	'address' => $form_data->address,
	'city' => $form_data->city,
]);
 if($id)
 {
  $message = 'Registration Completed';
 }
}
else
{
 $validation_error = implode(", ", $error);
}

$output = array(
 'error'  => $validation_error,
 'message' => $message
);

echo json_encode($output);

/*
      //try{
		$error= $request->validate([
            'first_name' => 'required',
			'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
			'country' => 'required',
			'address' => 'required',
			'city' => 'required',
        ]);
		print_r($error);die;
        $input = $request->all();
        $user = User::create($input);
        
        //auth()->login($user);
        
       // return redirect()->to('/');
	   
	  // }
	  //catch(\Exception $e) {
		//   dd($error);
       // return response($e->getMessage());
       // }
*/
    }
	
	 /**
     * Get a JWT via given credentials.
    */
    public function login(Request $request){
    	$form_data = json_decode(file_get_contents("php://input"));
        if(empty($form_data->email))
         {
           $error[] = 'Email is Required';
		 }
		 else
		 {
		  if(!filter_var($form_data->email, FILTER_VALIDATE_EMAIL))
		  {
		    $error[] = 'Invalid Email Format';
		  }
		 
		}

        if(empty($form_data->password))
        {
           $error = 'Password[] is Required';
        }
        if (!empty($error)) {
			$validation_error = implode(", ", $error);
			$output = array(
                      'error' => $validation_error
                    );

             echo json_encode($output);exit;
            //return response()->json($req->errors(), 422);
        }
            //$credentials = $request->only();
			//echo $token = JWTAuth::attempt($credentials);exit;
        if (!$token = JWTAuth::attempt(["email" => $form_data->email, "password" => $form_data->password])) {
        //return response()->json(['error' => 'Unauthorized'], 401);
		$output = array(
                      'error' => "Invalid login"
                    );

             echo json_encode($output);exit;
      }
	  //echo 1;exit;
      return $this->respondWithToken($token);
      //echo json_encode(array('token' =>$this->respondWithToken($token)));exit;
    }
	
	
	
	public function dashboard(){
		
		return view('main');
		
	}
	/**
     * Sign out
    */
    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => JWTFactory::getTTL() * 60
      ]);
    }
	
	
	
	
}
