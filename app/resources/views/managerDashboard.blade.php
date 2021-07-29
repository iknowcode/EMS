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
        padding-bottom: 70px;
    }
    </style>
</head>

<body class="d-flex flex-column h-100 row align-items-center">
    <x-header />

    <div class="card text-center">
        <div class="card-header"></div>
        <div class="card-body">
            @foreach($userdata as $user)
            <h5 class="card-title">Welcome, {{$user->first_name ." ". $user->last_name}} ( {{$user->type_of_user}} )
            </h5>
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
        @foreach($userdata as $user)
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
        @endforeach
    </table>


    <h5 class="mt-2 mt-3 mb-3"> Following are the issues by your reporties</h5>
    <table class="table w-50">
        <thread>
            <tr>
                <th>Raised by (ID) </th>
                <th>Type </th>
                <th>Description </th>
                <th>Status </th>
                <th>Action </th>
            </tr>
        </thread>
        @foreach($issues as $i)

        <tr>
            <td>{{ $i->emp_id }}</td>
            <td>{{ $i->issue_type }}</td>
            <td>{{ $i->issue_desc}}</td>
            <td>{{ $i->status }}</td>
            <td>
                <a href="">None</a>
            </td>
            @endforeach
    </table>

    <h5 class="mt-2 mt-3 mb-3">Following projects are under your management</h5>

    <table class="table w-50">
        <thread>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Project Description </th>
                <th>Project Start Date</th>
                <th>Project End Date </th>
                <th>
                    <a href="" data-toggle="modal" data-target="#editModal" onclick="hide_section1()">Add/Remove</a>
                    </td>
            </tr>
        </thread>
        @foreach($projects as $p)
        <tr>
            <td>{{ $p->project_id }}</td>
            <td>{{ $p->project_name}}</td>
            <td>{{ $p->project_desc }}</td>
            <td>{{ $p->project_start_date }}</td>
            <td>{{ $p->project_end_date }}</td>

            @endforeach
            <td>
                <!-- <a href="" data-toggle="modal" data-target="#editModal" onclick="hide_section1()">Add/Remove</a> -->
            </td>
    </table>
    <!-- Reportees -->
    <h5 class="mt-2 mt-3 mb-3">Following are the reportees under your management</h5>

    <table class="table w-50">
        <thread>
            <tr>
                <th>Emp ID</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Date Of Birth</th>
                <th>Communication Address</th>
                <th>Gender</th>
                <th>City</th>
                </td>
            </tr>
        </thread>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->emp_id }}</td>
            <td>{{ $user->first_name ." ". $user->last_name}}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->DOB }}</td>
            <td>{{ $user->comm_address }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->city }}</td>

        </tr>
        @endforeach

    </table>


    <!-- Issues Raising -->
    <div class="d-flex justify-content-around">

        <div class="d-flex flex-column m-4 p-4">
            <h5>You may raise an issue here</h5>
            <form action="issue" method="GET">
                @csrf
                <div class="">
                    <div class="form-group">
                        <input type="number" class="form-control" name="emp_id" value="{{ $user->emp_id }}" hidden>
                        <input type="text" class="form-control mb-2" name="issue_type" placeholder="Enter issue type"
                            required />
                        <input type="text" class="form-control mb-2" name="issue_desc"
                            placeholder="Enter issue description" required />
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
                                <input type="text" id="form1input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                <input type="number" id="form1input2" class="form-control" name="newMobileNumber"
                                    placeholder="Enter new Mobile Number" required />

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

                                <input type="number" id="form2input1" class="form-control" name="emp_id"
                                    value="{{ $user->emp_id }}" hidden />
                                <input type="text" id="form2input2" class="form-control" name="newAddress"
                                    placeholder="Enter New Address" required />


                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- These below modals are for Adding or Deleting the Data from Projects for a Manager -->

                    <!-- Section 2 -->
                    <div class="form-outline" id="addusertoproject">

                        <form action="addEmp" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Add User to a Project</h5>

                                <input type="number" class="form-control" name="manager_id" value="{{ $user->emp_id }}"
                                    hidden />
                                <input type="text" class="form-control" name="emp_id"
                                    placeholder="Enter Employee ID to add " required />
                                <input type="number" class="form-control" name="proj_id"
                                    placeholder="Enter Project ID to add " required />

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Add User</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-outline" id="deleteuserfromproject">

                        <form action="deleteEmp" method="post">
                            @csrf

                            <div class="form-group">
                                <h5 id="form2heading">Remove User from a Project</h5>

                                <input type="number" class="form-control" name="manager_id" value="{{ $user->emp_id }}"
                                    hidden />
                                <input type="number" class="form-control" name="emp_id"
                                    placeholder="Enter Employee ID to delete" required />
                                <input type="number" class="form-control" name="proj_id" placeholder="Enter Project ID"
                                    required />

                                <button type="button" class="btn btn-secondary p-2 m-2"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary p-2 m-2">Remove User</button>
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
    function hide_section2() {
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");

        //If section is hidden make it visible

        section1div1.removeAttribute("hidden");
        section1div2.removeAttribute("hidden");
        //Hide Section 2 

        var section2div1 = document.getElementById("addusertoproject");
        var section2div2 = document.getElementById('deleteuserfromproject');

        section2div1.setAttribute("hidden", "");
        section2div2.setAttribute("hidden", "");
    }

    function hide_section1() {
        var section1div1 = document.getElementById("updatemobile");
        var section1div2 = document.getElementById("updateaddress");

        var section2div1 = document.getElementById("addusertoproject");
        var section2div2 = document.getElementById('deleteuserfromproject');

        //Hide Section 1
        section1div1.setAttribute("hidden", "");
        section1div2.setAttribute("hidden", "");
        //Unhide Section 2
        section2div1.removeAttribute("hidden");
        section2div2.removeAttribute("hidden");
    }
    </script>

</body>

</html>