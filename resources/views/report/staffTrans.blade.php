<!DOCTYPE html>
<html>
<head>
  <title>{{$title}}</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
    <div style="text-align: center;">
        <img src="{{public_path('logo/logo.png')}}" alt="logo" width="180" height="60">
        <h1>{{$title}}</h1>
    </div>
   
      <div class="col-lg-12" style="margin-top:5px ">     
        
        <div class="pull-right">
        <h4>As of: {{$date}}</h4>
          
        </div>
      </div>
    </div><br>
    <table class="table table-bordered table-striped table-sm">
      <thead class="thead-dark">
        <th>#</th>
        <th>Staff Names</th>
        <th>Staff ID</th>
        <th>Purpose</th>
        <th>Amount</th>
        <th>Balance</th>
        <th>Trans Type</th>
        <th>Transaction Date</th>
        
      </thead>
      @foreach ($results as $data)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->first_name }}  {{ $data->middle_name }} {{ $data->last_name }}</td>
        <td>{{ $data->staff_id }}</td>
        <td>{{ $data->purpose }}</td>
        <td>{{ $data->amount }}</td>
        <td>{{ $data->balance }}</td>
        <td style="color: {{ $data->transaction_type === 'top-up' ? 'green' : 'red' }}">
            {{ $data->transaction_type }}
        </td>




        <td>{{ \Carbon\Carbon::parse($data->transaction_date)->format('jS F Y') }}</td>
       

      </tr>
      @endforeach
    </table>
  </div>
  <p class="mb-2 text-center"><I>Report generated by <b>{{ Session::get('username')}}</b>  on {{ $mytime = Carbon\Carbon::now(); }} <br>Report generated from PettyQash </I></p>
</body>
</html>