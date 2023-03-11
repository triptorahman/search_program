
@extends('layouts.master')
@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Search List</h1>
                    </div>
                </div>
            </div>
           
            

        </div>
        @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="card-body">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <th>SL</th>
                        <th>Keyword</th>
                        <th>Search Used For</th>
                        <th>Search Result</th>
                        <th>Search Date</th>
                        
                        
                      
                    </thead>
                    <tbody>
                       @foreach ($list as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->keyword}}</td>
                            <td>{{$row->search_used}}</td>
                            <td>{{$row->search_result}}</td>
                            <td>{{$row->date}}</td>
      
                       </tr>
                        @endforeach
          
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        
@endsection

@section('script')

        
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>

        
@endsection

