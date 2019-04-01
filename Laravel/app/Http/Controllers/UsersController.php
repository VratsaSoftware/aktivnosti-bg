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
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct(){
      //Middleware users
        $this->middleware('protect.users');
    } 

    public function index()
    {

        //show different user list for admins and moderators
        if(Auth::user()->hasRole('admin'))
        {
            $users = User::all();
        }
        elseif(Auth::user()->hasRole('moderator')){
            $roleAdmin = Role::select('role_id')->where('role','admin')->first();
            $users = User::all()->whereNotIn('role_id',[$roleAdmin->role_id]);
        }
        else
        {
            return view('citadel.home')->with('message', 'Нямате достъп до тази страница!');
        }     
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
        $user = User::findOrFail($id);
        return view('users.show',compact('user'));
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

        //prepare roles
        $rolesPluck= (['0' => 'Няма']+Role::pluck('role','role_id')->toArray()); 
        $roles = (isset($userRole) ?  [$userRole => $rolesPluck[$userRole]] + $rolesPluck : $rolesPluck);

        //remove admin option for non-admin users
        if(!Auth::user()->hasRole('admin'))
        {
            unset($roles[array_search('admin',$roles)]);
        }

        //prepare approved options
        $approvals = ($user->isApproved()) ? $approvals=['1'=> 'Одобрен']+['0' => 'Неодобрен'] : $approvals=['0' => 'Неодобрен']+ ['1'=> 'Одобрен'];

        isset($user->photo->image_path) ? $photo = $user->photo->image_path : '';

        //prepare categories
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

        $user->approved_at = ($request->get('approved')==1) ? (date('Y-m-d H:i:s')): NULL;
        
        if($request->get('role') == 0)
        {
            $user->role_id = NULL;
        }
        else
        {
            $user->role_id = $request->get('role');
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
        $user->updated_by = Auth::user()->email;
        $user->categories()->sync($categories);
        
        $user->save();

        return redirect('citadel/users')->with('message', 'Промените са запазени успешно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete())
        {
            $user->deleted_by = Auth::user()->email;
            $user->save();
        return redirect()->back()->with('message', 'Потребителят е изтрит');
        }
        else
        {
            redirect()->back()->with('message', 'Грешка!');
        }
    }

    public function approve($id)
    {
        $user = User::find($id);
        $user->approved_at = (date('Y-m-d H:i:s'));
        $user->approved_by = Auth::user()->email;
        $user->save();
        return redirect()->back()->with('message', 'Потребителят '.$user->name.' '.$user->family.' '.$user->email.' е одобрен!');
    }
}
