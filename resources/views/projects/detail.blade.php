@extends('layouts.app')
@section('title', '| Project detail')

@section('content')
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Project Detail <small> design</small></h3>
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
                            <h2>New Partner Contracts Consultancy</h2>
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

                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <ul class="stats-overview">
                                    <li>
                                        <span class="name"> Estimated budget </span>
                                        <span class="value text-success"> 2300 </span>
                                    </li>
                                    <li>
                                        <span class="name"> Total amount spent </span>
                                        <span class="value text-success"> 2000 </span>
                                    </li>
                                    <li class="hidden-phone">
                                        <span class="name"> Estimated project duration </span>
                                        <span class="value text-success"> 20 </span>
                                    </li>
                                </ul>
                                <br />
                                <h2>Tasks:</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{__('Task')}}</th>
                                            <th>{{__('Description')}}</th>
                                            <th>{{__('Project')}}</th>
                                            <th>{{__('Starts')}}</th>
                                            <th>{{__('Ends')}}</th>
                                            <th>{{__('Status')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($project->tasks as $task)
                                            <tr>
                                                <td><a href="{{route("tasks.show", ['id' => $task->id])}}">{{ $task->name }}</a></td>
                                                <td>{{ $task->description }}</td>
                                                <td>{{ $task->project_id }}</td>
                                                <td>{{ $task->start }}</td>
                                                <td>{{ $task->end }}</td>
                                                <td>{{ $task->status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <button onclick="location.href='{{ route('tasks.create') }}'" class="w3-button w3-block w3-theme-l1 w3-left-align">
                                        <i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Add Task </button>
                                </div>
                                <h2>Members:</h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th colspan="3" style="text-align: center">Operations</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                    @foreach($project->members as $member)
                                        <tr>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->email }}</td>
                                            <td>{{ $member->technologies()->pluck('name')->implode(', ') }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <button onclick="location.href='{{ URL::to('projects/'.$project->id.'/addMember')  }}'" class="w3-button w3-block w3-theme-l1 w3-left-align">
                                        <i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Add Members </button>
                                </div>

                                <div>

                                    <h4>Recent Activity</h4>

                                    <!-- end of user messages -->
                                    <ul class="messages">
                                        <li>
                                            <img src="images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">24</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Desmond Davison</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-error">21</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Brian Michaels</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                                    <a href="#" data-original-title="">Download</a>
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="images/img.jpg" class="avatar" alt="Avatar">
                                            <div class="message_date">
                                                <h3 class="date text-info">24</h3>
                                                <p class="month">May</p>
                                            </div>
                                            <div class="message_wrapper">
                                                <h4 class="heading">Desmond Davison</h4>
                                                <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                                <br />
                                                <p class="url">
                                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- end of user messages -->


                                </div>


                            </div>

                            <!-- start project-detail sidebar -->
                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <section class="panel">

                                    <div class="x_title">
                                        <h2>Project Description</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <h3 class="green"><i class="fa fa-paint-brush"></i> {{$project->name}}</h3>

                                        <p>{{$project->description }}</p>
                                        <br />

                                        <div class="project_detail">

                                            <p class="title">Client Company</p>
                                            <p>{{$project->client->name}}</p>
                                            <p class="title">Project Leader</p>
                                            <p>Tony Chicken</p>
                                        </div>

                                        <br />
                                        <h5>Project files</h5>
                                        <ul class="list-unstyled project_files">
                                            <li><a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                                            </li>
                                            <li><a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                                            </li>
                                            <li><a href=""><i class="fa fa-mail-forward"></i> Email-from-flatbal.mln</a>
                                            </li>
                                            <li><a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                                            </li>
                                            <li><a href=""><i class="fa fa-file-word-o"></i> Contract-10_12_2014.docx</a>
                                            </li>
                                        </ul>
                                        <br />

                                        <div class="text-center mtop20">
                                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                                            <a href="{{ URL::to('projects/'.$project->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                        </div>
                                    </div>

                                </section>

                            </div>
                            <!-- end project-detail sidebar -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection