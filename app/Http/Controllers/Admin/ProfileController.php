<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
     return view('admin.profile.create')   ;
    }
    
    public function create(Request $request)
    {   
        $this->validate($request,Profile::$rules);
        $profile= new Profile;
        $form = $request->all();
        unset($form['_token']);
        $profile->fill($form)->save();
        return redirect('admin/profile/create');
    }
    
    public function index(Request $request){
        $cond_title = $request->cond_title;
        if($cond_title != '') {
            $posts = Profile::where('name', $cond_title)->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index',['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
    
}
