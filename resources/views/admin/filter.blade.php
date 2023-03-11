@extends('admin.layouts.master')
@section('content')

<div class="container">
 

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form id='filter_form' method="POST" >
    {{@csrf_field()}}
    
    
    <div class="form-group">
      <h5>All Keywords:</h5>
      @foreach ($keywords as $key => $item)


        <label for="keyword{{$key}}">{{$item->keyword}} ({{$item->total}} times found)</label>
        <input type="checkbox" class="keyword" id="keyword{{$key}}" name="keywords[]" value="{{$item->keyword}}" ><br>
   
      @endforeach

    </div>

    <div class="form-group">
      <h5>All Users:</h5>
      @foreach ($users as $key => $item)

        <label for="user{{$key}}">{{$item->user_info->name}}</label>
        <input type="checkbox" class="user" id="user{{$key}}" name="users[]" value="{{$item->user_id}}" ><br>
    
      @endforeach

    </div>


    <div class="form-group">
      <h5>Time Range:</h5>

      <label for="yesterday">Yesterday</label>
      <input type="checkbox" id="yesterday" name="time_range" value="1"><br>
    
      <label for="last_week">Last week</label>
      <input type="checkbox" id="last_week" name="time_range" value="2"><br>
    
      <label for="last_month">Last month</label>
      <input type="checkbox" id="last_month" name="time_range" value="3"><br>
      

    </div>

    

    <div class="form-group">
      <h5>Select Date:</h5>

      <label for="yesterday">Enter start date</label>
      <input type="date" id="start_date" name="start_date" value="start_date"><br>
      <label for="yesterday">Enter end date</label>
      <input type="date" id="end_date" name="end_date" value="end_date">
    
      
      

    </div>

    


    

    

    <div class="form-group">
        
      <button type="button" id="search_button" class="btn btn-primary">Search</button>
        
    </div>

    <div  id="search_result"></div>

  </form>

</div>



@endsection

@section('script')
<script>

$(document).ready(function() {

    $('input[name="time_range"]').change(function() {
      $('input[name="time_range"]').not(this).prop('checked', false);
    });
    $('#search_button').click(function(event) {
        event.preventDefault();

       
        
        var selectedKeywords = $('input[name="keywords[]"]:checked').map(function() {
            return this.value;
        }).get();

        // console.log(selectedKeywords);
        
        var selectedUsers = $('input[name="users[]"]:checked').map(function() {
            return this.value;
        }).get();

        // console.log(selectedUsers);

        var selectedTimeRange = $('input[name="time_range"]:checked').val();

        if(selectedTimeRange){

          var time_range = selectedTimeRange;

        }else{
          var time_range = 0;
        }

        // console.log(time_range);
        
        var startDate = $('#start_date').val();
        // console.log(startDate);
        var endDate = $('#end_date').val();
        // console.log(endDate);

        if(startDate || endDate){
          //if startDate selected then endDate need also
          if(startDate && endDate){
            var flag=1;
          }else{
            var flag=0;
          }
        }else{
          var flag=1;
        }

        // console.log('flag='+flag);

        if(flag==1){

            $.ajax({
              type: "POST",
              dataType: "json",
              url: "<?php echo route('admin.search.post') ?>",
              data: {
                  _token: '{{ csrf_token() }}',
                  startDate: startDate,
                  endDate:endDate,
                  time_range:time_range,
                  selectedKeywords:selectedKeywords,
                  selectedUsers:selectedUsers




              },
              beforeSend: function() {
                  
              },
              success: function(data) {

                $('#search_result').empty();
                $('#search_result').html(data.schema);
                  

                  
              }
            });

        }else{
          alert('Please select both start date and end date');
        }

        


        
        // do something with the selected values
    });
});
  
</script>
@endsection