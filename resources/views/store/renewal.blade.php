@extends('layouts.layout')
@section('content')

<div class="main-panel">
<div class="content-wrapper">
<div class="col-12 grid-margin createtable">
              <div class="card">
                <div class="card-body">
           
                  
                        <div class="row">
                        <div class="col-md-6">
                                 <h4 class="card-title">Renewel Store</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('store.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
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
                  <form class="form-sample"  action="{{ route('store.renewal.post') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                        

                    <input type="hidden" class="form-control"  name="store_id"  value="{{$store->id}}"   />
    
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Subscription End Date</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control"  name="suscription_end_date"    />
                          </div>
                        </div>
                      </div>



                          




                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="description" ></textarea>
                         
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

@endsection