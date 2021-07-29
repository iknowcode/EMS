<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title> User Page </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body {
        height: 80%;
        padding-bottom: 90px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-header />


    <div class="card text-center">
        <div class="card-body">
            @foreach($Users as $user)
            @if ($user->type_of_user == 'Admin')
            <h5 class="card-title">Welcome, {{$user->first_name ." ". $user->last_name}} , ({{ $user->type_of_user }})
            </h5>
            @endif
            @endforeach

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <p class="card-text">
                Please find your details below
            </p>
        </div>
    </div>

    <!-- Personal Details of Admin -->
    <table class="table w-50">
        <thread>
            <tr>
                <th>Emp ID</th>
                <th>Name</th>
                <th>Password</th>
                <th>Mobile Number</th>
                <th>Date Of Birth</th>
                <th>Communication Address</th>
                <th>Gender</th>
                <th>City</th>
                <th>Operation</th>
            </tr>
        </thread>
        @foreach($Users as $user)
        @if( $user->type_of_user == 'Admin' )
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->comm_address }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->city }}</td>
            <td>
                <a href="" data-toggle="modal" data-target="#editModal" onclick="hide_section2()">Edit Details</a>
            </td>
        </tr>
        @endif
        @endforeach
    </table>

    <!-- All the users in the Database  -->
    <h5 class="mt-2 mt-3 mb-3"> Following is the list of all the users registered in the Database</h5>

    @if( $NumberOfUsers > 0)
    <table class="table w-50">
        <thread>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Remove Employee</th>
                <th>Details</th>
                <th>Change details</th>
                <th>Projects</th>

            </tr>
        </thread>    

        @foreach($Users as $user)
        @if ($user->type_of_user != 'Admin' )
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</a></td>
            <td><a href={{"delete/". $user->emp_id}}>Delete</a></td>
            <td><a href={{"empDet/".$user->emp_id}}>View details</a></td>
            <td><a href={{"edit/". $user->emp_id}}>Edit details</a></td>
            <td><a href={{"projdet/".$user->emp_id}}>View Projects</a></td>
        </tr>

        @endif
        @endforeach

        @else
        <h4>No Registered Users So far</h4>


        @endif

    </table>


    <!-- @if(Session::has('success'))
    <div class="alert alert-success">{{session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{session::get('fail')}}</div>
    @endif -->

    <h5 class="mt-2 mt-3 mb-3"> Following is the list of all the Projects in the Database</h5>


    <table class="table w-50">
        <thread>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Project Description </th>
                <th>Project Start Date</th>
                <th>Project End Date </th>
                <th>Operation</td>
            </tr>
        </thread>
        @foreach($projects as $p)
        <tr>
            <td>{{ $p->project_id }}</td>
            <td>{{ $p->project_name}}</td>
            <td>{{ $p->project_desc }}</td>
            <td>{{ $p->project_start_date }}</td>
            <td>{{ $p->project_end_date }}</td>
            <td><a href={{"editproj/". $p->project_id}}>Edit project details</a></td>
            @endforeach
    </table>
    <!-- Add Delete buttons for Project -->
    <div class="d-flex row align-items">
        <button type="button" data-toggle="modal" data-target="#editModal" onclick="hide_section1()" class="btn btn-primary">Add Project </button>
    </div>

    <h5 class="mt-2 mt-3 mb-3"> Following is the list of all the Issues</h5>

    <table class="table w-50">
        <thread>
            <tr>
                <th>Issue Type </th>
                <th>Description </th>
                <th>Raised by(emp ID)</th>
                <th>Status</th>
                <th>Edit Status</th>
            </tr>
        </thread>

        @foreach($issues as $i)

        <tr>
            <td>{{ $i->issue_type }}</td>
            <td>{{ $i->issue_desc}}</td>
            <td>{{ $i->emp_id }}</td>
            <td>{{ $i->status }}</td>
            <td>
                <form action="updatestatus" method="post" class="d-flex-inline">
                    {{method_field('PUT')}}
                    @csrf
                    <input name="id" value={{$i->issue_id}} hidden>
                    <select id="statusUpdate" class="btn btn-secondary dropdown-toggle" name="status">
                        <option value="closed">closed</option>
                        <option value="proccecing">proccecing</option>
                    </select>

                    <button type="submit" class="btn btn-info ml-2 mt-sm-2 mt-md-2 mt-lg-0">Change</button>

                </form>
            </td>

            @endforeach
    </table>
    <!-- Issue Box -->
    <div class="d-flex justify-content-around">

        <div class="d-flex flex-column m-4 p-4">
            <h5>You may raise an issue here</h5>
            <form action="issue" method="GET">
                @csrf
                <div class="">
                    <div class="form-group">
                        <input type="number" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                        <input type="text" class="form-control mb-2" name="issue_type" placeholder="Enter issue type"required/>
                        <input type="text" class="form-control mb-2" name="issue_desc"
                            placeholder="Enter issue description" required/>
                        <button type="submit" class="btn btn-warning w-100">Submit Issue</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <x-footer />

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mobileModalLabel">Change Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Section 1 -->
                    <div class="form-outline" id="updatemobile">

                        <form action="updateMobile" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form1heading"> Update mobile number</h5>
                                @foreach($Users as $user)
                                @if ($user->type_of_user == 'Admin')
                                <input type="text" id="form1input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                @endif
                                @endforeach

                                <input type="number" id="form1input2" class="form-control" name="newMobileNumber"
                                    placeholder="Enter new Mobile Number" required/>

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-outline" id="updateaddress">

                        <form id="form2" action="updateAddress" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Update User Address</h5>
                                @foreach($Users as $user)
                                @if ($user->type_of_user == 'Admin')
                                <input type="number" id="form2input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                @endif
                                @endforeach


                                <input type="text" id="form2input2" class="form-control" name="newAddress"
                                    placeholder="Enter New Address" required/>


                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-outline" id="addproject">
                    <!-- Add Project  Section 2-->
                        <form action="addProj" method="POST">
                            <div class="">
                                <div class="form-group">
                                    @csrf
                                    <label  class="m-2">Enter project Name</label>

                                    <input type="text" class="form-control" name="project_name"
                                        placeholder="Enter project name" required/>
                                        <span style="color:red">
                                        @error('project_name')
                                        {{$message}}
                                        @enderror
                                    </span>

                                    <label class="m-2">Enter project Description</label>
                                    <textarea type="text" class="form-control" name="project_desc"> </textarea>
                                    <span style="color:red">
                                        @error('project_desc')
                                        {{$message}}
                                        @enderror
                                    </span>

                                    <label class="m-2">Enter Project Start Date</label>
                                    <input type="date" class="form-control" name="start_date" required/>
                                    <span style="color:red">
                                        @error('start_date')
                                        {{$message}}
                                        @enderror
                                    </span>

                                    <label class="m-2">Enter Project End Date</label>
                                    <input type="date" class="form-control" name="end_date"/>
                                    <span style="color:red">
                                        @error('end_date')
                                        {{$message}}
                                        @enderror
                                    </span>

                                    <button type="button" class="btn btn-secondary p-2 m-2"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary m-2 p-2">Add Project</button>

                                </div>
                            </div>
                        </form>
                     
                    </div>


                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

<script>

    function hide_section2(){
        console.log('hide2 called');
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");
        section1div1.removeAttribute("hidden");
        section1div2.removeAttribute("hidden");
        var section2div1 = document.getElementById("addproject");
        section2div1.setAttribute("hidden","");

    }

    function hide_section1(){
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");

        section1div1.setAttribute("hidden","");
        section1div2.setAttribute("hidden","");
        
        var section2div1 = document.getElementById("addproject");
        section2div1.removeAttribute("hidden");

    }

</script>

</body>

</html>