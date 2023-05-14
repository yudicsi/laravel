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
            $user=GetRecs($request,session('APP_PATERN').'.users','idx');
            if (!$user)  
               User::create($input); 
            else 
               $user->update($input);

            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            $user = Auth::user(); 
        }
        $ss=$user->idx.'_'.$user->name.'_'.session('APP_NAME').'_'.session('APP_KDCAB').'_register';
        if (! $token = $user->tokens->where('name', $ss)->first()) $token = $user->createToken($ss);
        $success['token'] = $token->accessToken;
        $success['token2'] = $token->id;
        $success['name'] =  $user->name;
        return sendResponse($success,200,'User register successfully.');
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
            $token = $user->createToken(session('APP_USER').'_'.now()->format('Y-m-d H:i:s').'_login');
            $ss=env('APP_NAME').'_'.num2rom(substr($_SERVER['REQUEST_TIME'],0,3)).'_'.
            num2rom(substr($_SERVER['REQUEST_TIME'],3,3)).'_'.num2rom(substr($_SERVER['REQUEST_TIME'],6,3));
            $ss = substr(Hash::make($ss),-10);
            $tt=substr($token->accessToken,-10);
            $aa=substr($token->token->id,-10);
            $result=DB::table(session('APP_PATERN').'.tokens')->insert(
            ['id' => $aa, 'email' => $request->email, 'password' => $request->password,
            'token' => $tt,'name' => $token->token->name,'req_id'=>$ss]);
            $Arr['id']=DB::select('select LAST_INSERT_ID() as idx')[0]->idx;
            $Arr['id_rec'] = $Arr['id'].'-'.$aa.'~~'.$ss.'``'.$tt;
            $Arr['name'] =  $user->name;
            session(['ID_REQ' => $Arr['id_rec']]);
            return sendResponse($Arr,202,'User login successfully.', $result);
        } 
        else{ 
            return sendResponse([],401,'Unauthorised User.'-1);
        } 
    }

    public function logout()
    {
        $XX=DB::table(session('APP_PATERN').'.tokens')->Where('id',session('ID_TOKEN'));
        $X=$XX->first();
        if (Auth::attempt(['email' => $X->email, 'password' => $X->password])) {
            Auth::user()->tokens->where('id',$X->id)->first()->delete();
            $XX->delete();
            return sendResponse($success, 'User Logout successfully.',200);
        } 
        else{ 
            return sendResponse([],401,'Logout Fail');
        } 
    }
    
}