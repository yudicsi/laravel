<?php
namespace App\__aaa\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\db;
use Carbon\Carbon;
use Validator;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return sendResponse($validator->errors(),false,'Validation Error, OK !!!',401);
        }
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        $user = Auth::user(); 
        if (!$user) {
            $input = $request->only('idx','name', 'email', 'password');
            $input['password'] = Hash::make($input['password']);
            $user=GetRecs($request,$_SESSION['APP_PATERN'].'.users','idx');
            if (!$user)  
               User::create($input); 
            else 
               $user->update($input);

            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $user = Auth::user(); 
        }
        $ss=$user->idx.'_'.$user->name.'_'.$_SESSION['APP_NAME'].'_'.$_SESSION['APP_KDCAB'].'_register';
        if (! $token = $user->tokens->where('name', $ss)->first()) $token = $user->createToken($ss);
        $success['token'] = $token->accessToken;
        $success['token2'] = $token->id;
        $success['name'] =  $user->name;
        return sendResponse($success, 'User register successfully.',200);
    }
   
   /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],true)){ 
            $user = Auth::user(); 
            $token = $user->createToken($_SESSION['APP_USER'].'_'.now()->format('Y-m-d H:i:s').'_login');
            $_SESSION['APP_TOKEN']=$token->accessToken;
            $_SESSION['KEY_TOKEN2']=$token->token->id;
            $_SESSION['NAME_TOKEN']=$token->token->name;
            $success['token'] = $_SESSION['APP_TOKEN'];
            $success['name'] =  $user->name;
            return sendResponse($success, 'User login successfully.',200);
        } 
        else{ 
            return sendResponse([],'Unauthorised.',401);
        } 
    }

    public function logout()
    {
        $X=DB::SELECT('select email, '.$_SESSION['APP_PATERN'].'.SF_CodeToStr(UserPassword) as Password from '.
        $_SESSION['APP_PATERN'].'.user1 where CONCAT(id,"_",dateadd)=?',[substr($_SESSION['APP_USER'],0,22)]);
        if (Auth::attempt(['email' => $X[0]->email, 'password' => $X[0]->Password])) {
            $user = Auth::user(); 
            $token = $user->tokens->where('name',$_SESSION['NAME_TOKEN'])->first();
            $token->delete();
            return sendResponse($success, 'User Logout successfully.',200);
        } 
        else{ 
            return sendResponse([],'Logout Fail',401);
        } 
    }
    
}