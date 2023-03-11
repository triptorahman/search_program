<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Search;
use Carbon\Carbon;



class HomeController extends Controller
{
    public function index() {

        // dd('here');
        return view('admin.dashboard');
    }

    public function filter() {
        
        $keywords = Search::select('keyword', \DB::raw('count(*) as total'))
             ->groupBy('keyword')
             ->get();

        $users = Search::with('user_info')->select('user_id')
            ->groupBy('user_id')
            ->get();

            //  dd($user);
        
        return view('admin.filter',compact('keywords','users'));
    }


    public function filterPost(Request $request) {

        if ($request->ajax()) {


            // dd($request->all());
            // DB::enableQueryLog();
            
            $query = Search::with('user_info');
            
            if($request->startDate && $request->endDate){

                $query->where('date','>=',$request->startDate)->where('date','<=',$request->endDate);

               

            }

            if(isset($request->selectedKeywords)){
                
                $query->whereIn('keyword',array_values($request->selectedKeywords));
                
            }

            if(isset($request->selectedUsers)){
                
                $query->whereIn('user_id',array_values($request->selectedUsers));
                
            }

            if($request->time_range != '0'){
                if($request->time_range == '1'){

                   
                   
                    $yesterday = Carbon::now('Asia/Dhaka')->subDay()->format('Y-m-d');
                   
                    // dd($today);
                    $query->where('date',$yesterday);

 
                    

                }
                else if($request->time_range == '2'){

                    $last_week_start_date = Carbon::now('Asia/Dhaka')->subWeek()->startOfWeek()->format('Y-m-d');
                    $last_week_end_date = Carbon::now('Asia/Dhaka')->subWeek()->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('date',[$last_week_start_date, $last_week_end_date]);
                    

                }else if($request->time_range == '3'){

                    $last_month_start_date = Carbon::now('Asia/Dhaka')->subMonth()->startOfMonth()->format('Y-m-d');
                    $last_month_end_date = Carbon::now('Asia/Dhaka')->subMonth()->endOfMonth()->format('Y-m-d');

                    $query->whereBetween('date',[$last_month_start_date, $last_month_end_date]);

                }

            }

            $search_result = $query->get();
            // dd(DB::getQueryLog());

            $data = view('admin.filter_result',compact('search_result'))->render();
            return response()->json(['schema' => $data]);

            
        }

        

    }

    
}
