@extends('layouts.master')
@section('content')
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                  
    
                    <div class="page-title">
                        <h1>User Dashboard</h1>
                    </div>
                   
                    
                    
                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="content mt-3">

            <div class="col-sm-6 col-lg-3">
                <div class="card text-black bg-flat-color-2">
                    
                   <div class="card-body ">
                       <h5 class="card-title" >Information</h5>
                       <p class="card-text " style="color: black">Name : {{Auth::user()->name}}</p>
                       <p class="card-text " style="color: black">Email : {{Auth::user()->email}}</p>
                       
                       
                     </div>

                        
                </div>
                
            </div>

            


        </div>

        

        

@endsection