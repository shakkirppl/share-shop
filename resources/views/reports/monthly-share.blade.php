@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Monthly Share Report</h4>
                    </div>
                   
                       
                   
                </div>
                <form class="form-sample"  action="{{url('monthly-share-report')}}" method="get" >
                          {{csrf_field()}}
                    <div class="row">
                     
                     

                      <div class="col-md-4 col-sm-6 col-xs-12 mt-2">
                      <select class="form-control" name="month" id="month">
                    <option>Select Month</option>
                    @foreach($months as $key => $month)
                 <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                    </select>
                    </div>
                   
                    <div class="col-md-2 col-sm-6 col-xs-12 mt-2">
                    <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Get


</button>
</div>

                    </div></div>
</form>       
@if($message = Session::get('success'))
<div class="alert alert-sucess">
  <p>{{$message}}</p>
</div>
@endif
 
                 
                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" >
                      <thead>
                        <tr>
                          <th>Month</th>
                          <th>Income</th>
                          <th>Expense</th>
                          <th>Profit</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                   <tr>
                    <td>{{$selectmonth}}</td>
                    <td>{{$income}}</td>
                    <td>{{$expense}}</td>
                    <td>{{$profit}}</td>
                    <td>@if($selectmonth) <a class="btn btn-minier btn-warning btn-edit" href="{{ route('monthly-report-detail/',$selectmonth) }}">View Detail</i>@endif</td>
                   </tr>
                      </tbody>
                    </table>
                  </div>


                  <div class="table-responsive">
                    <table class="table table-hover" id="value-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Partner</th>
                          <th>Percentage</th>
                          <th>Profit</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($partnerStore))
                        @foreach($partnerStore as $key=>$partnrstore)
                        <tr id="">
                            <td>{{$key+1}}</td>
                            <td class="name">@foreach($partnrstore->partner as $part){{$part->name}}@endforeach</td>
                            <td class="name">{{$partnrstore->percentage}}</td>
                            <td class="name">{{($profit*$partnrstore->percentage)/100}}</td>
                   
                      </tr>
                        @endforeach
                        @else
                        <tr><td colspan="2">Sorry, No Records found!</td></tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            
@endsection
@section('script')
<script>
    $(document).ready( function () {
    $('#value-table').DataTable();
} );
</script>
@endsection
