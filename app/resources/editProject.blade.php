<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


<h3>Update Project Details</h3>
<form action = "updateProjectDetails" method="post">
    @csrf
    <div class="col-lg-4">
    <div class="form-group">
    @foreach ($proj as $item)
    <label for="">Project Id</label>
    <input type="number" class="form-control" name="project_id" value="{{ $item->project_id }}"><br>
    
    <label for="">Project Name</label>
    <input type="text" class="form-control" name="project_name" value="{{ $item->project_name }}"><br>
    
    <label for="">Project Description</label>
    <textarea type="text" class="form-control" name="project_desc">{{ $item->project_desc }}
    </textarea><br> 
   
    <label for="">Project Start Date</label>
    <input type="text" class="form-control" name="project_start_date" value="{{ $item->project_start_date }}"><br>
    
    <label for="">Project End Date</label>
    <input type="date" class="form-control" name="project_end_date" value="{{ $item->project_end_date }}">
    @endforeach
    <br>
    <button>Update</button>
     <button>Cancel</button>
        </div>
    </div>
</form>