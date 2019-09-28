<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    public function __construct(){

        $this->middleware('protect.schedule')->except(['addScheduleGroup','index','show']);

    }

    public function review ($groupId)
    {
        $group = Group::findOrFail($groupId);

        return view ('schedules.review', compact('group'));
    }

    public function addScheduleGroup($groupId)
    {
        $group = Group::findOrFail($groupId);

        return view ('schedules.create', compact('group'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = Schedule::create([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'group_id' => $request->group_id,

        ]);

        //validate schedule requests

        $groupId = $request->group_id;

        return redirect('/citadel/schedule/'.$groupId.'/review')->with('message', 'Създадено е ново разписание');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);
        $schedules = Schedule::all();

        return view ('schedules.show', compact('schedules', 'group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $groups = Group::all();

        return view ('schedules.edit', compact('groups', 'schedule'));
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
        $schedule = Schedule::find($id);
        $schedule->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time ,
            'updated_by' => Auth::user()->email
        ]);

        //validate schedule requests

        $groupId = $request->group_id;

        return redirect('/citadel/schedule/'.$groupId.'/review')->with('message', 'Разписанието е редактирано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->deleted_by = Auth::user()->email;
        $schedule->save();
        $schedule->delete();

        $groupId = $schedule->group_id;

        return redirect('/citadel/schedule/'.$groupId.'/review')->with('message', 'Разписанието '.$schedule->name.' е изтрито!');
    }
}
