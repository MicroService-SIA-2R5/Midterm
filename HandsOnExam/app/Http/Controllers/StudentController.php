<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

Class StudentController extends Controller {

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getUsers()                              //SHOW ALL USERS
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function add(Request $request){                  //ADD USER
        
        $rules = [
            'studid' => 'required|max:8',
            'lastname' => 'required|max:50',
            'firstname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'bday' => 'required|max:5000',
            'age' => 'required|lte:49'
        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());
        return response()->json($user, 200);
    }
    
    public function update(Request $request,$id)            //UPDATE USER
    {
        $rules = [
            $this->validate($request, [
                'studid' => 'required|max:8',
                'lastname' => 'required|alpha:max:50',
                'firstname' => 'required|alpha:max:50',
                'middlename' => 'required|alpha:max:50',
                'bday' => 'required|max:5000',
                'age' => 'required|lte:49'
            ])  
        ];
        $this->validate($request, $rules);

        $user = User::findOrFail($id);

        $user->fill($request->all());
    
        $user->save();
    
        return $user;
    }

    public function deleteStudent($id) {                // DELETE USER
        $user = User::where("studid", $id)->delete();
    
        if($user){
            return response()->json($user);
        }
        else{
            return $this->errorResponse("User ID Does not Exist", Response::HTTP_NOT_FOUND);
        }
    }

    public function show($id){                          //SEARCH USER
        $user = User::where('studid', $id)->first();

        if($user){
            return response()->json($user);
        }
        else{
            return $this->errorResponse("User ID Does not Exist", Response::HTTP_NOT_FOUND);
        }
    }
}