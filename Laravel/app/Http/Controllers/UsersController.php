<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Photo;
use App\Models\Purpose;
use App\Models\Category;
use App\Models\Organization;
use App\Http\Requests\UserFormRequest;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
            
        return view('users.index',compact('users'));
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
    public function store(Request $request)
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
        //
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

        //prepare data for view
        $userRole = $user->role_id;

        $rolesPluck= (['0' => 'Няма']+Role::pluck('role','role_id')->toArray()); 
        $roles = (isset($userRole) ?  [$userRole => $rolesPluck[$userRole]] + $rolesPluck : $rolesPluck);

        $approvals = ($user->isApproved()) ? $approvals=['1'=> 'Одобрен']+['0' => 'Неодобрен'] : $approvals=['0' => 'Неодобрен']+ ['1'=> 'Одобрен'];

        isset($user->photo->image_path) ? $photo = $user->photo->image_path : '';

        $categories = Category::pluck('name', 'category_id');
        $userCategories = $user->categories->pluck('category_id')->toArray();

        $organizations = ($user->organizations->pluck('name','organization_id')->toArray())+['0' => 'Без Организация']+(Organization::select('organization_id','name')->pluck('name','organization_id')->toArray());


        return view('users.edit')->with(compact('user'))->with(compact('roles'))->with(compact('approvals'))->with(compact('photo'))->with(compact('categories'))->with(compact('userCategories'))->with(compact('organizations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {   
        
        $user = User::find($id);
        $categories = $request->get('categories');

        $user->name = $request->get('name');
        $user->family = $request->get('family');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $user->approved_at = ($request->get('approved')==1) ? (date('Y-m-d H:i:s')): NULL;
        
        if($request->get('role') == 0)
        {
            $user->role_id = NULL;
        }
        else
        {
            $user->role_id = $request->get('role');
        } 

        if(isset($request['description']))
        {
            $user->description = $request->get('description');
        }

        if(isset($request['organization']))
        {
            if($request->get('organization') == 0)
            {
                $user->organizations()->detach();
            }
            else
            {
            $user->organizations()->sync([$request->get('organization')]);
            }
        }
        
        if(!$user->hasRole('moderator')){
            $categories=[];
        }

        $user->categories()->sync($categories);
        
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

        return redirect('citadel/users')->with('message', 'Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->back()->with('message', 'Потребителят е изтрит');
    }

    public function approve($id)
    {
        $user = User::find($id);
        $user->approved_at = (date('Y-m-d H:i:s'));
        $user->save();
        return redirect()->back()->with('message', 'Потребителят '.$user->name.' '.$user->family.' '.$user->email.' е одобрен!');
    }
}
