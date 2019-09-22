<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\SubscribeFormRequest;
use App\Models\Organization;
use App\Models\Category;
use App\Models\Activity;
use App\Models\Subscription;
use App\Models\Newsletter;
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')){

            $newsletters = Newsletter::all();


             return view('subscribe.index', compact('newsletters','desired'));
        }
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
    public function store(SubscribeFormRequest $request)
    {
        $subscribе = new Subscription;
        $subscribе->email = $request->get('email');
        $subscribе->unsubscribed_global = true;
        $subscribе->save();
        foreach($request->get('category_id') as $category_id){

            $category = Category::find($category_id);
            $category->newsletters()->create([
                        'unsubscribed' => false,
                        'subscription_id' =>  $subscribе->subscription_id,
                    ]);

        }
        return redirect()->back()->with('message', 'Създадохте абонамент');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return redirect()->back()->with('message', 'Абонамента на '.$newsletter->subscription->email.' е изтрит!');

    }
}
