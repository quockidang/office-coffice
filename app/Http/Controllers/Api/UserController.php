<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Carbon;
class UserController extends Controller
{

    protected $successStatus = 200;
    protected $userReposotory;

    public function __construct(UserRepositoryInterface $userReposotory)
    {
        $this->userReposotory = $userReposotory;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $phoneValidate = $request->phone;
        $userPhone = User::where('phone', $phoneValidate)->first();
        if ($userPhone) {
            return response()->json(['error' => 'Số điên thoại đã tồn tại'], 401);
        }
        $input = $request->all();

        $input['is_admin'] = 0;
        $input['role_id'] = 3;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success' => $success], $this->successStatus);
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $input['birthday'] = date('Y-m-d', strtotime($input['birthday']));
        $user = $this->userReposotory->update(Auth::id(), $input);
        //$user = Auth::user()->update($input);
        return response()->json($user, $this->successStatus);
    }

    public function getkey(){
        $userID = auth('api')->user()->getKey();
        return response()->json($userID, 200);
    }
}
