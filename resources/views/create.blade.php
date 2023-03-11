@extends('layouts.master')
@section('content')

<div class="container">
  <h2>Add Search</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form method="POST" enctype="multipart/form-data">
    {{@csrf_field()}}
    

    

    <div class="form-group">
      <label for="name">Search Keyword:</label>
      <input type="text" class="form-control" name="keyword" id="keyword"  placeholder="Enter Keyword">
    </div>

    <div class="form-group">
      <label for="name">Which Used Searched:</label>
      <input type="text" class="form-control" name="search_used" id="search_used"  placeholder="Enter uses of Search">
    </div>

    <div class="form-group">
      <label for="name">Search results:</label>
      <input type="text" class="form-control" name="search_result" id="search_result"  placeholder="Enter Search Result">
    </div>
    
    <div class="form-group">
        
        <input type="submit" class="btn btn-secondary" value="Post" name="Add">
    </div>

  </form>

</div>



@endsection