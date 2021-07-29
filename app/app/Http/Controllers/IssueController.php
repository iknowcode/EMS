<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    
    public function submitIssue(Request $req)
    {
        $issue = new issue;
        $issue->emp_id = $req->emp_id;
        $issue->issue_type = $req->issue_type;
        $issue->issue_desc = $req->issue_desc;
        $issue->status = "pending";
        $issue->save();
        return "issue submit success";
    }

    public function getIssue()
    {
       $issue = Issue::all();
       return view('managerDashboard' , ['issues' => $issue]); 
    }
}
