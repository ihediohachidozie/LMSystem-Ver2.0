<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use DB;
use App\PublicHoliday;
use App\Department;
use App\Category;
use App\Comment;
use App\Mail\LeaveApprovalMail;
use App\Mail\ConfirmRequest;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class LeaveController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth'); // locking all parts
    }

    private $outs;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $leaves = Leave::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);

        $leaveTypes = $this->leaveType();

        $users = User::all();

        $publicholidays = PublicHoliday::all()->pluck('date');
        
       // dd($leaves);
        return view('leave.index', compact('leaves','leaveTypes','users', 'publicholidays'));
    }

    // leave type array method
    private function leaveType()
    {
        return array('Annual','Causal','Examination','Sick','Paternity','Maternity');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $u = User::find(auth()->user()->id)->category;

        $users = DB::table('users')
        ->whereNotIn('id', [auth()->user()->id, 1])
        ->get();

        $approvals = DB::table('users')
                    ->where('permission', '=', 'on')
                    ->whereNotIn('id',[auth()->user()->id])
                    ->get();

        $leaveTypes = $this->leaveType();

        $leave = new Leave();

      //  return view('leave.create', compact('users', 'leaveTypes', 'leave', 'approvals')); 
        
        if($u == null)
        {
            return back()->withStatus(_('You have not been activated'));
        }
        else{
            return view('leave.create', compact('users', 'leaveTypes', 'leave', 'approvals')); 
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validatedData();

        if($this->checkLeavestatus($request->user_id))
        {
            if($this->sameDate($request->user_id, $request->start_date))
            {
                if($this->outstandingDays($request->user_id, $request->year, $request->days))
                {
                    $this->getOutstanding($request->user_id, $request->year, $request->days);

                    $leave = new Leave();

                    $leave->start_date = request('start_date');
                    $leave->days = request('days');
                    $leave->outsdays = $this->outs;
                    $leave->year = request('year');
                    $leave->leave_type = request('leave_type');
                    $leave->duty_reliever = request('duty_reliever');
                    $leave->approval_id = request('approval_id');
                    $leave->user_id = request('user_id');
                    $leave->status = request('status');
                    //dd($leave);

                    $leave->save();

                    $userdata = User::Find(auth()->id());
                    
                    $email = User::where('id', $leave->approval_id)->pluck('email');
                    $when = now()->addMinutes(10);

                    Mail::to($email)->later($when, new LeaveApprovalMail($userdata));
                    
                    return redirect('leave')->withStatus(__('Leave Application successfully saved.'));
                }
                else{
                    return back()->withStatus(__('You have exceed approved days!'));
                }
            }
            else {
                return back()->withStatus(__('Leave entry already exist!'));
            }
        }
        else{
            return redirect('leave')->withStatus(__('You have either an open or pending or rejected Leave Application.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
        $leaveTypes = $this->leaveType();
        $users = User::all();
        return view('leave.show', compact('leave', 'leaveTypes', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
        $leaveTypes = $this->leaveType();
        
        $users = DB::table('users')
                ->whereNotIn('id', [auth()->id(), 1])
                ->get();
  
        $approvals = DB::table('users')
                     ->where('permission', '=', 'on')
                    ->get();

        return view('leave.edit', compact('leave', 'leaveTypes', 'users', 'approvals'));
    }

    // leave approval method
    public function approveleave(Request $request, $leave)
    {

        $data = request()->validate([
            'status' => 'sometimes',
            'comment' => 'sometimes',
           
        ]);

        $comment = ($request->input('comment'));
        
        $leave = Leave::findorfail($request->leave);
      
        $leave->update($data);
        $lastID = $leave->id;

        // save comments ...
        if($comment)
        {
            $saveCom = new Comment();
            $saveCom->user_id = $leave->user_id;
            $saveCom->approval_id = $leave->approval_id;
            $saveCom->leave_id = $lastID;
            $saveCom->comment = $comment;

            $saveCom->save();
        }


        // send an email to user & admin...

        $userdata = User::Find($leave->approval_id);

        $userdata1 = User::Find($leave->user_id);
        $when = now()->addMinutes(10);
 
        Mail::to($userdata1->email)->cc('hr.cal@ecmterminals.com')->later($when, new ConfirmRequest($userdata, $userdata1, $leave, $comment));

        if(auth()->id() == 1)
        {
            return redirect('leave.staffleaveentry')->withStatus(__('Action completed.'));

        }else{

            return redirect('leave.approval')->withStatus(__('Action completed.'));
            
        }

        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
        $this->validatedData();

        $this->getOutstanding($request->user_id, $request->year, $request->days);

        $leave->start_date = request('start_date');
        $leave->days = request('days');
        $leave->outsdays = $this->outs;
        $leave->year = request('year');
        $leave->leave_type = request('leave_type');
        $leave->duty_reliever = request('duty_reliever');
        $leave->approval_id = request('approval_id');
        $leave->user_id = request('user_id');
        $leave->status = request('status');

        if($request->start_date == $request->oldstartdate)
        {
            if($this->outstandingDays4Update($request->user_id, $request->year, $request->days, $request->olddays))
            {
          
                $leave->update();

                $userdata = User::Find(auth()->id());
                    
                $email = User::where('id', $leave->approval_id)->pluck('email');
                $when = now()->addMinutes(10);

                Mail::to($email)->later($when, new LeaveApprovalMail($userdata));
    
                return redirect('leave')->withStatus(__('Leave Application successfully updated.'));
            }
            else{
                return back()->withStatus(__('You have exceed approved days!'));
            }
        }
        else{
            if($this->sameDate($request->user_id, $request->start_date))
            {
                if($this->outstandingDays4Update($request->user_id, $request->year, $request->days, $request->olddays))
                {
                    $leave->update();

                    $userdata = User::Find(auth()->id());
                    
                    $email = User::where('id', $leave->approval_id)->pluck('email');
                    $when = now()->addMinutes(10);

                    Mail::to($email)->later($when, new LeaveApprovalMail($userdata));
        
                    return redirect('leave')->withStatus(__('Leave Application successfully updated.'));
                }
                else{
                    return back()->withStatus(__('You have exceed approved days!'));
                }
            }
            else {
                return back()->withStatus(__('Leave entry already exist!'));
            }
        }
    }


    private function getOutstanding($userid, $year, $curdays)
    {
        //get outstanding days if any
        $outsday = Leave::where(['user_id' => $userid, 'year' => $year, 'status' => '3'])->orderBy('id', 'desc')->pluck('outsdays')->first();

        // approved days
        $approved_days = User::find($userid)->category->days;

        $this->outs = $outsday ? $outsday - $curdays : $approved_days - $curdays;

        return $this->outs;
    }

    // data validation method..
    private function validatedData()
    {
       return request()->validate([
            'start_date' => 'required',
            'days' => 'required|max:30|min:1',
            
            'year' => 'required|numeric|min:2006|max:2050',
            'leave_type' => 'required',
            'duty_reliever' => 'required',
            'approval_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        // 'outsday => 'required|min:' .$outsday
        
        // $last_row = DB::table('products')->orderBy('id', 'desc')->first();

        // $outsday = Leave::where(['user_id' => $id], ['year' => $year])->orderBy('id', 'desc')->first();
        // $result = $outsday->outsdays;

        // $outsday = Leave::where(['user_id' => $id], ['year' => $year])->orderBy('id', 'desc')->pluck('outsday')->first();

        // $outsday = DB::table('table_name')->select('col_name');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

     //return 'Approval page';
     public function approval()
     {
         
         //$leaves = Leave::leftJoin('users', 'users.id', '=', 'leaves.user_id')->select('users.firstname', 'leaves.*')->orderBy('id', 'desc')->paginate(8);
         $leaves = Leave::leftJoin('users', 'users.id', '=', 'leaves.user_id')->select('users.firstname', 'leaves.*')->where([['leaves.status', '>', 0],['approval_id', '=', auth()->id()]])->orderBy('id', 'desc')->paginate(8);
         $leaveTypes = $this->leaveType();
         $users = User::all();
         $publicholidays = PublicHoliday::all()->pluck('date');
       // $userid = Auth::user()->id;
      // dd($leaves);
         return view('leave.approval', compact('leaves','leaveTypes','users', 'publicholidays')); 
     }
 
     // Check if user id has applied for the same start date ....
     private function sameDate($userid, $startdate)
     {
         $result = Leave::where(['user_id' => $userid, 'start_date' => $startdate])->count();
         return $result == 0 ? true : false ;
     }
 
     // Outstanding leave days for a particular year...
     private function outstandingDays($userid, $year, $curdays)
     {

        // days utilized
        $days_utilized = Leave::where(['user_id' => $userid, 'year' => $year])->groupBy('year')->sum('days');

        // approved days
        $approved_days = User::find($userid)->category->days;
        
        // outstanding days
        $outsday = Leave::where(['user_id' => $userid, 'year' => $year])->orderBy('id', 'desc')->pluck('outsdays')->first();
        
        if($outsday != null)
        {
            $result = ( $outsday >= $curdays ) ? true : false;
        }
        else
        {
            $result = ($approved_days >=  $curdays) ? true : false;
        }
        
        return $result;
     }
 
     // Outstanding leave days for update method
     private function outstandingDays4Update($userid, $year, $curdays, $oldday)
     {
 
         $days_utilized = Leave::where(['user_id' => $userid, 'year' => $year, 'status' => '3'])->groupBy('year')->sum('days');
 
         // approved days
         $approved_days = User::find($userid)->category->days;

        // outstanding days
        $outsday = Leave::where(['user_id' => $userid, 'year' => $year, 'status' => '3'])->orderBy('id', 'desc')->pluck('outsdays')->first();
        
        if($outsday != null)
        {
            $result = ( $outsday >= $curdays ) ? true : false;
        }
        else
        {
            $result = ($approved_days >=  $curdays) ? true : false;
        }
        
        return $result;
 
        //return $result = $approved_days >= ($days_utilized + $curdays) ? true : false;
     }
 
     //leave summary method
     public function leaveSummary()
     {
         if(User::find(auth()->id())->category != null)
         {
             $days = User::findOrfail(auth()->user()->id)->category->days;

             

             $leaveSummaries = DB::table('leaves')
             ->select('year', DB::raw('sum(days) as days'))
             ->where(['user_id'=> auth()->user()->id, 'status' => 3])
             ->groupBy('year')
             ->pluck('days', 'year');
      
              return view('leave.leaveSummary', compact('leaveSummaries', 'days'));
         }else
         {
             return back()->withStatus(__('No category assigned!'));
         }
 
     }
 
     // Check for existing leave that is pending or rejected..
     private function checkLeavestatus($userid)
     {
         //$result = Leave::where(['user_id' => $staffid, 'status' => 0])->orwhere('status', 1)->count();
         $result = DB::table('leaves')->where([
             ['user_id', '=', $userid],
             ['status', '<>', '3']
         ])->count();
 
         return $result == 0 ? true : false ;
     }
 
     public function staffleaveentry()
     {
         $leaves = Leave::where('status', '3')->orderBy('id', 'desc')->paginate(5);
 
         $leaveTypes = $this->leaveType();
 
         $users = User::all();
 
         $publicholidays = PublicHoliday::all()->pluck('date');
 
         //return $publicholidays->count();
 
         return view('leave.staffleave', compact('leaves','leaveTypes','users', 'publicholidays'));
     }
 
     public function staffhistory($id)
     { // dd('I m here!');
         //$user = User::find($id);
 
         $users = User::all();
 
         $leaveTypes = $this->leaveType();
 
         $publicholidays = PublicHoliday::all()->pluck('date');
 
         $leaves = DB::table('leaves')->leftJoin('users', 'users.id', '=', 'leaves.user_id')->select('users.firstname','leaves.*')->where([['user_id', '=', $id],['status', '=', '3']])->orderBy('year', 'DESC')->paginate(5);

         $username = User::find($id);
        
         return view('leave.userhistory', compact('leaves', 'users', 'publicholidays', 'leaveTypes', 'username'));
  
     }
 
     public function staffsummary($id)
     {
         $user = User::find($id);
 
         //$days = User::findOrfail(auth()->user()->id)->category->days;
 
         $staffleave = $this->leavegroupedbyyear($id);
   
         return view('leave.usersummary', compact('user', 'staffleave'));
 
     }
 
     private function leavegroupedbyyear($id)
     {
         // grouping the leave entries by year
         $lsum = DB::table('leaves')
         ->select('year', DB::raw('sum(days) as days'))
         ->where('user_id', $id)
         ->where('status', '3')
         ->groupBy('year')
         ->pluck('days', 'year');
 
         return $lsum;
     }
 
     public function getUser()
     {
         // all users except admin
         $users = User::where('id', '<>', 1)->paginate(8);
         return view('leave.user', compact('users'));
     }

     public function allUsersum()
     {
         // retrieve all users' summmary for Admin
       $leaves = DB::table('leaves')->leftJoin('users', 'users.id', '=', 'leaves.user_id')->select('users.firstname','leaves.year','leaves.days', 'leaves.user_id','leaves.approval_id', DB::raw('sum(days) as days, sum(outsdays) as odays'))->where('status', '=', 3)->groupBy('year', 'user_id')->paginate(10);
      // dd($leaves);
       return view('leave.allsummary', compact('leaves'));
     }
    
    /*  public function allUsersumAp()
            {
                // retrieve all users' summmary for HOD
            $leaves = DB::table('leaves')->leftJoin('users', 'users.id', '=', 'leaves.user_id')->select('users.firstname','leaves.year','leaves.days', 'leaves.user_id', 'leaves.approval_id', DB::raw('sum(days) as days, sum(outsdays) as odays'))->where('status', '=', 3)->groupBy('year', 'user_id')->paginate(5);
            return view('leave.allsummary', compact('leaves'));
            } */

        /*      public function chgstatus(Leave $leave)
            {
                dd('im here');
                $leaveTypes = $this->leaveType();
                $users = User::all();
                return view('leave.changestatus', compact('leave', 'leaveTypes', 'users'));
            } */
}
