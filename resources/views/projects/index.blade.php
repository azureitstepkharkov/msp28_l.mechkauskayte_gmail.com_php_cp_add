@extends('layouts.app')
@section('title', '| Projects')

@section('content')
    <!-- page content -->
    {{--<div class="right_col" role="main">--}}
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Projects <small>Listing design</small></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Projects</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <p>Simple table with project listing with progress and editing options</p>

                            <!-- start project list -->
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th style="width: 1%">#</th>
                                    <th style="width: 20%">Project Name</th>
                                    <th>Team Members</th>
                                    <th>Add Members</th>
                                    <th>Project Progress</th>
                                    <th>Status</th>
                                    <th style="width: 20%">#Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>#</td>
                                    <td>
                                        <a>{{$project->name}}</a>
                                        <br />
                                        <small>Created {{$project->created_at}}</small>
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li>
                                                <img src="images/user.png" class="avatar" alt="Avatar">
                                            </li>
                                            <li>
                                                <img src="images/user.png" class="avatar" alt="Avatar">
                                            </li>
                                            <li>
                                                <img src="images/user.png" class="avatar" alt="Avatar">
                                            </li>
                                            <li>
                                                <img src="images/user.png" class="avatar" alt="Avatar">
                                            </li>
                                        </ul>
                                    </td>
                                <td>
                                    <a href="{{ URL::to('projects/'.$project->id.'/addMember') }}" class="btn btn-default btn-xs">Add Members</a>
                                </td>
                                    <td class="project_progress">
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                                        </div>
                                        <small>57% Complete</small>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs">Success</button>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('projects/'.$project->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                        <a href="{{ URL::to('tasks/create') }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Add Task </a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id] ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-xs')) !!}
                                        {!! Form::close() !!}
                                        {{--<a href="{{URL::to('projects/'.$project->id)}}"><i class="fa fa-trash-o"></i> Delete </a>--}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- end project list -->
                            <a href="{{ URL::to('/projects/create') }}" class="btn btn-success">{{__('Add Project')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--</div>--}}
    <!-- /page content -->
@endsection