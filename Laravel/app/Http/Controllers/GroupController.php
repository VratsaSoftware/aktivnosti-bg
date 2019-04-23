<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Group;
use App\Models\Schedule;

class GroupController extends Controller
{
    
    public function addGroupActivity($groupId)
    {
        $activity = Activity::findOrFail($groupId);
        
        return view ('groups.create', compact('activity'));
    }
    public function review ($activityId)
    {
        $activity = Activity::findOrFail($activityId);

        return view ('groups.review', compact('activity'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view ('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
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
        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'activity_id' => $request->activity_id,
        ]);

        $group->schedules()->create([
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time ,
            ]);

        //validate group requests

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на групата трябва да съдържа минимум три знака'
        ]);

        $activityId = $request->activity_id;
       
        return redirect('/citadel/group/'.$activityId.'/review')->with('message', 'Създадена е нова група');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        $groups = Group::all();
        $schedules = Schedule::all();

        return view ('groups.show', compact('groups', 'schedules', 'activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $activities = Activity::all();

        return view ('groups.edit', compact('activities', 'group'));
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
       $group = Group::find($id);
       $group->update([
            'name' => $request->name,
            'description' => $request->description,
            'activity_id' => $request->activity_id,
        ]);

        $this->validate($request, [
            'name' => 'required|min:3', 
            'description' => 'required|max:500'
        ], [
            'name.min' => 'Името на групата трябва да съдържа минимум три знака'
        ]);
        
        $activityId = $request->activity_id;
       
        return redirect('/citadel/group/'.$activityId.'/review')->with('message', 'Групата е редактирана');
        // return redirect('citadel/group/'.($id))->with('message', 'Групата е редактирана');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();

        $activityId = $group->activity_id;
        return redirect('/citadel/group/'.$activityId.'/review')->with('message', 'Група '.$group->name.' е изтрита!');
        // return redirect('citadel/group/')->with('message', 'Група '.$group->name.' е изтрита!');
    }
}
