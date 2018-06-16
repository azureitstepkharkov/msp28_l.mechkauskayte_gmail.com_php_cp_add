<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all(); //get all tasks
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::usersForTasks();
        // $projects = Project::all();//Get all projects TODO: Project model
        $projects = [1=>1]; //temporary array; TODO: remove when Project model will be created
        $statuses = ['new' => 'new',
            'in_progress' => 'in_progress',
            'completed' => 'completed',
            'canceled' => 'canceled'];
        return view('tasks.create', ['projects'=>$projects, 'statuses' => $statuses, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name and project_id field
        $this->validate($request, [
                'name'=>'required|max:150',
                'project_id' =>'required',
            ]
        );

        $task = Task::create($request->only('name', 'project_id', 'description', 'start', 'end', 'status'));
        $users = $request['users'];

        if(Auth::user()->hasRole('Client')){
            $user_t = User::where('id', '=', Auth::user()->id)->firstOrFail();
            $task->attachUser($user_t); //Assigning role to user
            $task->save();
            flash('Task '. $task->name.' was added!');
            return redirect()->route('tasks.showTask', Auth::user()->id);
        }
        else{
            if (isset($users)) {

                foreach ($users as $user) {
                    $user_t = User::where('id', '=', $user)->firstOrFail();
                    $task->attachUser($user_t); //Assigning role to user
                }
            }
            $task->save();
            flash('Task '. $task->name.' was added!');
            return redirect()->route('tasks.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $technologies = DB::table('technologies')
            ->leftJoin('task_technology as tt', 'technologies.id', '=', 'tt.id_technology')
            ->select('technologies.id', 'technologies.name', 'technologies.description')
            ->where('tt.id_task', $id)->get();
        //converting collection to array (to compare with another array)
        $arr_task_technologies = [];
        foreach ($technologies as $t)
        {
            $arr_task_technologies[$t->id] = $t->name;
        }

        $project_technologies = DB::table('technologies')
            ->leftJoin('project_technology as pt', 'technologies.id', '=', 'pt.id_technology')
            ->select('technologies.id','technologies.name')
            ->where('pt.id_project', $task->project_id)->get();
        //converting collection to array (to compare with another array)
        $arr_project_technologies = [];
        foreach ($project_technologies as $p)
        {
            $arr_project_technologies[$p->id] = $p->name;
        }

        //getting only technologies, that are not currently presented in this task,
        //passing it into view (in select)
        $project_technologies = array_diff($arr_project_technologies, $arr_task_technologies);

        $stuff = DB::table('users')
            ->leftJoin('task_user as tu', 'users.id', '=', 'tu.id_user')
            ->select('users.id','users.name')
            ->where('tu.id_task', $id)->get();
        $comments = DB::table('task_comment')->select('id', 'comment', 'created_at')->where('task_id', $id)->get();
        $files = DB::table('task_file')->select('id', 'path', 'created_at')->where('task_id', $id)->get();

        return view('tasks.show', compact('task','technologies', 'project_technologies', 'stuff', 'comments', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::usersForTasks();
        // $projects = Project::all();//Get all projects TODO: Project model
        $projects = [1=>1];  //temporary array; TODO: remove when Project model will be created
        $statuses = ['new' => 'new',
            'in_progress' => 'in_progress',
            'completed' => 'completed',
            'canceled' => 'canceled'];
        return view('tasks.edit', compact('task', 'projects', 'statuses', 'users'));
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
        $task = Task::findOrFail($id);
        $this->validate($request, [
                'name'=>'required|max:150',
                'project_id' =>'required',
            ]
        );

       // $task->fill($request)->save();

        $task->name = $request['name'];
        $task->project_id = $request['project_id'];
        $task->description =  $request['description'];
        $task->start =  $request['start'];
        $task->end = $request['end'];
        $task->status = $request['status'];
        $users = $request['users'];
        $task->save();
        if (isset($users)) {
            $task->users()->sync($users);  //If one or more role is selected associate user to roles
        }
        else {
            $task->users()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        if(Auth::user()->hasRole('Client')){
            flash('Task '. $task->name.' was updated!');
            return redirect()->route('tasks.showTask', Auth::user()->id);
        }
        else{
            flash('Task '. $task->name.' was updated!');
            return redirect()->route('tasks.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        if(Auth::user()->hasRole('Client') || Auth::user()->hasRole('Programmer')) {
            $task->users()->detach();
            $task->delete();
            flash('Task '. $task->name.' was deleted!');
            return redirect()->route('tasks.showTask', Auth::user()->id);
        }
        else{
            $task->users()->detach();
            $task->delete();
            flash('Task ' . $task->name . ' was deleted!');
            return redirect()->route('tasks.index');
        }
    }

    public function showTask($id) {
        if(Auth::user()->hasRole('Client') || Auth::user()->hasRole('Programmer')) {
            $tasks = Task::showTaskForUsers($id); //get all tasks
        }
        else{
            $tasks = Task::all(); //get all tasks
        }
        return view('tasks.index')->with('tasks',  $tasks);
    }

    public function attach_technology(Request $request)
    {
        $task = Task::findOrFail($request->id);

        DB::table('task_technology')->insert([
            'id_task' => $request->id,
            'id_technology' => $request->technology,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        return redirect("tasks/$task->id");
    }

    public function detach_technology($task_id, $tech_id)
    {
        DB::table('task_technology')->where([
            ['id_task', '=', $task_id],
            ['id_technology', '=', $tech_id],
        ])->delete();
        return redirect("tasks/$task_id");
    }

    public function showCalendar()
    {
        $events = [];
        $data = Task::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->start),
                    new \DateTime($value->end.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#ff0000',
                        'url' => 'pass here url and any route',
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);
       //return view('fullcalendar', compact('calendar'));
      return view('calendar', compact('calendar'));
    }
}
