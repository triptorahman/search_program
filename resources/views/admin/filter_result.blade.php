<table class="table table-striped">
  <thead>
    <tr>
      
      <th scope="col">Sl</th>
      <th scope="col">Keyword</th>
      <th scope="col">Used For</th>
      <th scope="col">Search Result</th>
      <th scope="col">Date</th>
      <th scope="col">Created By</th>
    </tr>
  </thead>
  <tbody>
   
    @foreach ($search_result as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$row->keyword}}</td>
            <td>{{$row->search_used}}</td>
            <td>{{$row->search_result}}</td>
            <td>{{$row->date}}</td>
            <td>{{$row->user_info->name ?? ''}}</td>

        </tr>
    @endforeach
    
  </tbody>
</table>