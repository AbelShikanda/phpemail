<?php

namespace App\Http\Controllers;

use App\Mail\phpmail;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JobsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::orderByDesc('created_at')->get();
        return view('jobs.index', with([
            'jobs' => $jobs,
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create', with([
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = $request->validate([
            'job' => 'required',
            'salary' => 'required',
        ]);
        $users = User::all();
        $emails = $users->pluck('email')->toArray();

        try {
            DB::beginTransaction();
            $job = Jobs::create([
                'name' => $request->input('job'),
                'salary' => $request->input('salary'),
            ]);

            // Mail::to($emails)->send(
            //     new phpmail($job)
            // );

            Mail::to('dummy@example.com')
            ->bcc($emails)
            ->send(new phpmail($job));
            
            // Mail::to('dummy@example.com')
            // ->bcc($emails)
            // ->queue(new phpmail($job));

            if (!$job) {
                DB::rollBack();
                return back()->with('error', 'oops, something went wrong');
            }
            DB::commit();
            return redirect()->route('jobs')->with('message', 'successfully added a job');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobs = Jobs::find($id);
        return view('jobs.show', with([
            'jobs' => $jobs,
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobs = Jobs::find($id);
        return view('jobs.edit', with([
            'jobs' => $jobs,
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = $request->validate([
            'job' => '',
            'salary' => '',
        ]);

        try {
            DB::beginTransaction();
            $job = Jobs::where('id', $id)->update([
                'name' => $request->input('job'),
                'salary' => $request->input('salary'),
            ]);

            if (!$job) {
                DB::rollBack();
                return back()->with('error', 'oops, something went wrong');
            }
            DB::commit();
            return redirect()->route('jobs')->with('message', 'successfully added a job');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jobs  $jobs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = Jobs::find($id);
        $jobs->delete();
        return redirect()->route('jobs')->with('message', 'successfully deleted the job');
    }
}
