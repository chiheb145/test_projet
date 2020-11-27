<?php

namespace App\Http\Controllers\back;


use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id','desc')->get();
        $roles=Role::orderBy('id','asc')->get();

        return view('back.users.index',[
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles=Role::orderBy('id','asc')->get();
        $from=1;

        return view('back.users.create',[
            'roles' => $roles,
            'from' => $from,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        //$user = User::create($request->all());

        $user=new User();
        $user->name=$request->name;
        $user->role_id=$request->role_id;
        $user->email=$request->email;
        $user->status=0;
        $user->password=Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $from=2;
        $roles=Role::orderBy('id','asc')->get();
        $user=User::find($id);

        return view('back.users.create',compact('user','from','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }


        $user = User::find($id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        if($request->password)
            $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index');
    }

     public function delete ($id){
         $user = User::findOrFail($id);
         $user->status=1;
         $user->save();

         return redirect()->route('user.index');

       }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
