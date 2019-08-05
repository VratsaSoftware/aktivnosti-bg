<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Photo;
use App\Models\Purpose;
use App\Http\Requests\ProfileFormRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
      //Middleware profile
        $this->middleware('protect.profile')->except(['index']);;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        return view('profile.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileFormRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $request->user();
        return view('profile.index',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get user
        $user = User::findOrFail($id);

        isset($user->photo->image_path) ? $photo = $user->photo->image_path : '';

        return view('profile.edit')->with(compact('user'))->with(compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileFormRequest $request, $id)
    {
        $user = User::find($id);
        
        $user->name = $request->get('name');
        $user->family = $request->get('family');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');

        if(isset($request['description']))
        {
            $user->description = $request->get('description');
        }
                
        $user->save();

        isset($user->photo->image_path) ? $photo = $user->photo->image_path : '';

        if(isset($request['photo'])){
            
            $file_name = (time().'p'.mt_rand(1,99));
            $store_file=$request['photo']->move('user_files/images/profile', $file_name);

            //prepare purposes table if not ready
            $photo_purpose = Purpose::where('description','profile')->first();
            if(!$photo_purpose){
                $photo_purpose=Purpose::firstOrCreate(['description' => 'profile']);
            }

            //store image in photos table
            if(!$photo){
            $user->photo()->create([
                'image_path' => $file_name,
                'alt' => 'user photo',
                'description' => 'profile photo' ,
                'purpose_id' => $photo_purpose->purpose_id,
            ]);
            }
            else
            {
                $user->photo->image_path = $file_name;
                $user->photo->update();
                
            }
            
        }//end of photo update

        return redirect('citadel/profile')->with('message', 'Успешно редактиране!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
