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
            date_default_timezone_set('Asia/Jakarta');
            $token = $user->createToken($_SESSION['APP_USER'].'_'.now()->format('Y-m-d H:i:s').'_login');
            $ss=env('APP_NAME').'_'.num2rom(substr($_SERVER['REQUEST_TIME'],0,3)).'_'.
            num2rom(substr($_SERVER['REQUEST_TIME'],3,3)).'_'.num2rom(substr($_SERVER['REQUEST_TIME'],6,3));
            $ss = substr(Hash::make($ss),0,100);
            $tt=substr($token->accessToken,0,100);
            DB::table($_SESSION['APP_PATERN'].'.tokens')->insert(
                ['id' => $token->token->id, 'email' => $request->email, 'password' => $request->password,
                'token' => $tt,'name' => $token->token->name,'req_id'=>$ss]
            );
            $xx=DB::select('select id FROM '.$_SESSION['APP_PATERN'].'.tokens Where req_id=?',[$ss]);
            $success['id'] = $xx[0]->id;
            $success['id_rec'] =  $ss;
            $success['token'] =  $tt;
            $success['name'] =  $user->name;
            $_SESSION['ID_REQ'] = $success['id'].'~~~'.$ss.'```'.$tt;
            return sendResponse($success, 'User login successfully.',200);
        } 
        else{ 
            return sendResponse([],'Unauthorised.',401);
        } 
    }

    public function logout()
    {
        $XX=DB::table($_SESSION['APP_PATERN'].'.tokens')->Where('id',$_SESSION['ID_TOKEN']);
        $X=$XX->first();
        if (Auth::attempt(['email' => $X->email, 'password' => $X->password])) {
            Auth::user()->tokens->where('id',$X->id)->first()->delete();
            $XX->delete();
            return sendResponse($success, 'User Logout successfully.',200);
        } 
        else{ 
            return sendResponse([],'Logout Fail',401);
        } 
    }
    
}