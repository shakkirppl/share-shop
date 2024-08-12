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
                                 <h4 class="card-title">New Store</h4>
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
                  <form class="form-sample"  action="{{ route('store.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                        
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Store Name" name="name"    />
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Company </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="company_id" name="comapny_id">
                          @foreach($company as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
    
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Logo</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="image"    />
                          </div>
                        </div>
                      </div>

                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Email</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="E-mail" name="email"    />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Emirate</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Emirate" name="emirate"    />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Country" name="country"    />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Contact No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact No" name="contact_number"    />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> WhatsApp No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="WhatsApp No" name="whatsapp_number"    />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Address</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="address" ></textarea>
                         
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Admin Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="User Name" name="username"  id="username"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password"   />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> No of User</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="No of User" name="no_of_users"    />
                          </div>
                        </div>
                      </div>

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
                          <label class="col-sm-2 col-form-label"> Buffer Days</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="Buffer Days" name="buffer_days"    />
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
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Status </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="status" name="status">
                      <option value="1">Active</option>
                     <option value="0">Deactive</option>
                       </select>
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
$( document ).ready(function() {
    $('input').attr('autocomplete','off');
});
</script>
@endsection