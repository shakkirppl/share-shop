@extends('layouts.layout')
@section('content')
<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>
<div class="main-panel">
<div class="content-wrapper">
<div class="col-12 grid-margin createtable">
              <div class="card">
                <div class="card-body">
           
                  
                        <div class="row">
                        <div class="col-md-6">
                                 <h4 class="card-title">Update Receipt Voucher</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('receipt-voucher.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    
                    <div class="row">
                    <br>
                   </div>
                
                  <div class="col-xl-12 col-md-12 col-sm-12 col-12">
           
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div><br />
          @endif
          
        </div>
                  <form class="form-sample"  action="{{ route('receipt-voucher.update',$receiptVoucher->id) }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                          @method('PUT')
                    <div class="row">
                        
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Date</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control"  name="in_date"  required="true" value="{{$receiptVoucher->in_date}}" />
                          </div>
                        </div>
                      </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Receipt </label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg" id="account_id" name="account_id">
                          @foreach($receipt as $receip)
                          @if($receiptVoucher->account_id==$receip->id)
                      <option selected value="{{$receip->id}}">{{$receip->name}}</option>
                      @else
                      <option  value="{{$receip->id}}">{{$receip->name}}</option>
                      @endif
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                           

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Description </label>
                          <div class="col-sm-9">
                          <textarea class="form-control" name="description" rows="4" cols="50">{{$receiptVoucher->description}} </textarea>
                          </div>
                        </div>
                      </div>
             
          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Amount</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="amount" id="amount" name="amount" required="true" step="any"  value="{{$receiptVoucher->amount}}"  />
                          </div>
                        </div>
                      </div>      
                             <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Vat</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="Vat" id="vat_amount" name="vat_amount" required="true"  value="{{$receiptVoucher->vat_amount}}"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Total Amount</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Vat" id="total_amount" name="total_amount" required="true"  value="{{$receiptVoucher->total_amount}}"  readonly  />
                          </div>
                        </div>
                      </div>

                      </div>
                
                <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i>


</button>
                    </div>
                    
                    
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
            </div>
               
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amount');
        const vatInput = document.getElementById('vat_amount');
        const totalAmountInput = document.getElementById('total_amount');

        function updateTotalAmount() {
            const amount = parseFloat(amountInput.value) || 0;
            const vat = parseFloat(vatInput.value) || 0;
            const total = amount + vat;
            totalAmountInput.value = total.toFixed(2);
        }

        amountInput.addEventListener('input', updateTotalAmount);
        vatInput.addEventListener('input', updateTotalAmount);
    });
</script>
@endsection