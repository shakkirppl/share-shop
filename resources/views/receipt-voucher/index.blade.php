@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Receipt Voucher</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('receipt-voucher.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
                    </div>
                       
                   
                </div>
                    
@if($message = Session::get('success'))
<div class="alert alert-sucess">
  <p>{{$message}}</p>
</div>
@endif
 
                 
                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover" id="value-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Date</th>
                          <th>Expense</th>
                          <th>Amount</th>
                          <th>Vat</th>
                          <th>Total Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($receipt))
                        @foreach($receipt as $key=>$rece)
                        <tr id="">
                            <td>{{1+$key}}</td>
                            <td class="name">{{$rece->in_date}}</td>
                            <td class="name"> @foreach($rece->receipt as $res){{$res->name}} @endforeach</td>
                            <td class="name">{{$rece->amount}}</td>
                            <td class="name">{{$rece->vat_amount}}</td>
                            <td class="name">{{$rece->total_amount}}</td>
                           
                            <td><form action="{{ route('receipt-voucher.destroy',$pay->id) }}" method="post">
                           
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                            </td>
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
