<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Users;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all(); //Get all projects

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = (User::showUsers('Client'));
        return view('projects.create', ['clients'=>$clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:150'
        ]);

        $project= new Project();
        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->clients_id = $request['client'];
        $project->save();


        //Redirect to the projects.index view and display message
        flash('Project '. $project->name. 'was added!');
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        $members = $project->members();
        return view('projects.detail', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = (User::showUsers('Client'));
        return view('projects.edit', ['project' => $project, 'clients' => $clients]);
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
        $project = Project::findOrFail($id);
        $this->validate($request, [
                'name'=>'required|max:150'
            ]
        );

        // $task->fill($request)->save();

        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->clients_id = $request['client'];
        $bool =  $request['status'];
        if($bool == 'on')
        {
            $project->status = true;
        }
        else
        {
            $project->status = false;
        }
        $project->save();
        flash('Project '.  $project->name.' was updated!');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        flash('Project ' . $project->name . ' was deleted!');
        return redirect()->route('projects.index');
    }

    public function showProgrammers($id)
    {
        $programmers = User::getEmployees();
        $project = Project::findOrFail($id);
        $members = $project->members();

        //$freeProgrammers = $programmers->diff($members);
        return view('projects.addMember', ['freeProgrammers' =>  $programmers, 'members'=> $members]);
    }
}
