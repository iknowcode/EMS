<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title> User Registration </title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            height: 100%
            }
    </style>
</head>

<body class="d-flex flex-column">
    <x-header/>

    <div class="card text-center">
          <div class="card-header">Featured</div>
          <div class="card-body">
            <h5 class="card-title">Welcome to User Registration Page</h5>
            <p class="card-text">
                Enter following details to get registered
            </p>
          </div>
    </div>

    <form action="register" method="POST" class="d-flex flex-column row align-items-center needs-validation" novalidate>
                <!-- Registration Form -->
    @csrf
      <div class="row mb-4">
        <div class="col">
        <div class="form-outline">
            <input type="text" id="first_name" name="first_name" class="form-control" required/>
            <label class="form-label" for="form3Example1">First name</label>
            <div class="invalid-feedback">
            Please provide first name correctly
            </div>
        </div>
        </div>
        <div class="col">
        <div class="form-outline">
            <input type="text" id="last_name" name="last_name" class="form-control" required />
            <label class="form-label" for="form3Example2">Last name</label>
            <div class="invalid-feedback">
            Please provide last name correctly
            </div>
        </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
        <div class="form-outline">
            <input type="text" id="mobile" name="mobile"  class="form-control" required/>
            <label class="form-label" for="form3Example1">Mobile</label>
            <div class="invalid-feedback">
              Please provide a valid mobile number
            </div>
        </div>
        </div>
        <div class="col">
        <div class="form-outline">
            <input type="date" id="dob" name="dob" class="form-control" / required>
            <label class="form-label" for="form3Example2">Date of Birth</label>
            <div class="invalid-feedback">
            Please provide your DOB
            </div>
        </div>
        </div>
    </div>

      <div class="row mb-4">
        <div class="col">
        <div class="form-outline">
            <input type="email" id="email" name="email" class="form-control" required/>
            <label class="form-label" for="form3Example1">Email</label>
            <div class="invalid-feedback">
            Please provide a valid email
            </div>
        </div>
        </div>
        <div class="col">
        <div class="form-outline">
            <input type="password" id="pass" name="pass" class="form-control" required />
            <label class="form-label" for="form3Example2">Password</label>
            <div class="invalid-feedback">
              Please provide a password
            </div>
        </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
        <div class="form-outline justify-between">
            <input type="text" id="address" name="address" class="form-control" required />
            <label class="form-label" for="address">Address</label>
            <div class="invalid-feedback">
              Please provide a valid address
            </div>
        </div>
        </div>

        <div class="col">
        <div class="form-check-inline" name="gender">

            <input class="form-check-input mr-2" type="checkbox"name ="gender"  value="male" id="gendercheck">
            <label class="form-check-label mr-2" for="flexCheckDefault">
                Male
            </label>

            <input class="form-check-input mr-2" type="checkbox" name ="gender" value="female" id="gendercheck">
            <label class="form-check-label mr-2" for="flexCheckDefault">
                Female
            </label>

            <input class="form-check-input" type="checkbox" value="" name ="gender" value="other" id="gendercheck">
            <label class="form-check-label" for="flexCheckDefault">
               Other
            </label>

        </div>
        </div>

    </div>


    <div class="row mb-4">
    <div class="col">
        <div class="form-outline">
            <select name="city" required>
            <option value="" disabled selected>Select City</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Pune">Pune</option>
            <option value="Delhi">Delhi</option>
            <option value="Mumbai">Mumbai</option>
            </select>
            <div class="invalid-feedback">
              Please choose a city
            </div>
        </div>
        </div>
    </div>


    <div class="row">
      <!-- Simple link -->
      <a href="/reset">Forgot password?</a>
    </div>
      </div>

      <button type="submit" value="Submit" onclick="validate_checkbox(event)" class="btn btn-primary mt-3">Register</button>
    </form>

    <script>
    
    function validate_checkbox(event){
        var checkboxes = document.getElementsByName('gender');
        var checked = 0;
        for( var i = 0; i < checkboxes.length; i++){
            if( checkboxes[i].checked  ){
                checked = 1;
            }
        }
        if( !checked ){
            alert("Please Select a gender");
            event.preventDefault();
        }
    }


    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
    </script>

    <x-footer/>

</body>
</html>
