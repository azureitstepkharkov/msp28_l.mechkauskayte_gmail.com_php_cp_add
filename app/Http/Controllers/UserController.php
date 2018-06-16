<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\Technology;
use Session;
use function Sodium\add;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth', /*'isAdmin'*/]); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Get all users and pass it to the view
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
        $technologies = $request['technologies'];
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->attachRole($role_r); //Assigning role to user
            }
        }

        if (isset($technologies)) {

            foreach ($technologies as $technology) {
                $technology_t = Role::where('id', '=', $technology)->firstOrFail();
                $user->attach($technology_t); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        flash('User '. $user->name. 'was added!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('users');
    }

    public function showProfile() {
//        $user = User::findOrFail($id); //Get user with specified id
//        $roles = Role::get(); //Get all roles
//        $technologies = Technology::get(); //Get all technologies

        return view('users.profile', compact('user', 'roles', 'technologies')); //pass user and roles data to view
    }

    public function showEditAvatar()
    {
        return view('image');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        $technologies = Technology::get(); //Get all technologies

        return view('users.edit', compact('user', 'roles', 'technologies')); //pass user and roles data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);
        $input = $request->only(['name', 'email', 'password', 'image']); //Retreive the name, email and password fields
        $roles = $request['roles']; //Retreive all roles
        $technologies = $request['technologies'];
//        if( $input[image] != null) {
        $path = $request['image'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            echo "Файл ". $_FILES['userfile']['name'] ." успешно загружен.\n";
            echo "Отображаем содержимое\n";
            readfile($_FILES['userfile']['tmp_name']);
        } else {
            echo "Возможная атака с участием загрузки файла: ";
            echo "файл '". $_FILES['userfile']['tmp_name'] . "'.";
        }



        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $user->image = $base64;
        $user->imageType = $type;
//            $image = $request->file('image');
//            $imageType = $image->getClientOriginalExtension();
//
//
//
//            $imageStr = (string)Image::make($image)->
//            resize(300, null, function ($constraint) {
//                $constraint->aspectRatio();
//            })->encode($imageType);

            //$user->image = base64_encode($imageStr);
            //$user->imageType = $imageType;
            $user->save();
//        }
        $user->fill($input)->save();


        if (isset($roles)) {
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
        }
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        if (isset($technologies)) {
            $user->technologies()->sync($technologies);  //If one or more role is selected associate user to roles
        }
        else {
            $user->technologies()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        flash('User '. $user->name. 'was updated!');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        $user->delete();

        flash('User '. $user->name. ' was deleted!');
        return redirect()->route('users.index');
    }
    public function inactive($id) {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);
        if($user->status === 'inactive'){
            $user->status = 'active';
            flash('User '. $user->name. ' was active!');
        }
        else{
            $user->status = 'inactive';
            flash('User '. $user->name. ' was inactive!');
        }
        $user->save();
        return redirect()->route('users.index');
    }

    public function showProgrammers() {
        $usersRoles = User::all();
        $users = [];
        for($i = 0; $i < count($usersRoles); $i++){
            if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Programmer'){
                array_push($users, $usersRoles[$i]);
            }
        }

        return view('users.index')->with('users', $users);
    }

    public function showEmployees() {
        $usersRoles = User::all();
        $users = [];
        for($i = 0; $i < count($usersRoles); $i++){
            if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'TeamLeader' ||
                $usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Programmer' ||
                $usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'ProjectMan'){
                array_push($users, $usersRoles[$i]);
            }
        }

        return view('users.index')->with('users', $users);
    }

    public function showClients() {
        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('ProjectMan') || Auth::user()->hasRole('TeamLeader')){
            $usersRoles = User::all();
            $users = [];
            for($i = 0; $i < count($usersRoles); $i++){
                if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Client'){
                    array_push($users, $usersRoles[$i]);
                }
            }
        }
        else{
            $users = User::showUsers('Client');
        }

        return view('users.index')->with('users', $users);
    }

}