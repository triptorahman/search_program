<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Search;



use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index() {
        return view('dashboard');
    }


    public function list() {

        // dd('here');
    
        $list = Search::where('user_id',Auth::user()->id)->get();
        // dd($user_list);
        return view('list',compact('list'));
    }


    public function create() {
        return view('create');
    }



    public function store(Request $request)
    {
        
        $this->validate(
            $request, 
            [   
                'keyword' => 'required',
                'search_used' => 'required',
                'search_result' => 'required',
                
                
            ],
            [
                'keyword.required' => 'keyword Field Required',
                'search_used.required' => 'search uses Field Required',
                'search_result.required' => 'search result Field Required',
                
            ]
        );


        $search = new Search; 
        $search->user_id = Auth::id();
        $search->keyword = $request->keyword; 
        $search->search_used = $request->search_used; 
        $search->search_result = $request->search_result; 
        $search->date = Carbon::now('Asia/Dhaka'); 
        
        $search->save();

       
       


        session()->flash('message', "Search add Sucessfully");
        return redirect()->route('user.search_list');
    }
}
