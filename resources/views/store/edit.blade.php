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
                                 <h4 class="card-title">Update Store</h4>
                        
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
                  <form class="form-sample"  action="{{ route('store.update',$store->id) }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                          @method('PUT')
                    <div class="row">
                        
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Store Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Store Name" name="name" value="{{$store->name}}"  required="true"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Company </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="company_id" name="comapny_id">
                          @foreach($company as $company)
                          @if($company->id==$store->company_id)
                          <option selected value="{{$company->id}}">{{$company->name}}</option>
                          @else
                      <option value="{{$company->id}}">{{$company->name}}</option>
                      @endif
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
                            <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{$store->email}}"    />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Emirate</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Emirate" name="emirate" value="{{$store->emirate}}"    />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Country</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Country" name="country"  value="{{$store->country}}"   />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Contact No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact No" name="contact_number" value="{{$store->contact_number}}"    />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> WhatsApp No</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="WhatsApp No" name="whatsapp_number" value="{{$store->whatsapp_number}}"    />
                          </div>
                        </div>
                      </div>
                          
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Address</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="address" >{{$store->address}}</textarea>
                         
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Currency</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Currency" name="currency"  value="{{$store->currency}}"   />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Vat Percentage</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Vat" name="vat_percentage"  value="{{$store->vat_percentage}}"   />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> TRN</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="TRN" name="trn"  value="{{$store->trn}}"   />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Admin Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="User Name" name="username"  value="{{$store->username}}"  required="true" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Password" name="password"   value="{{$store->password}}" required="true" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Description</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="description" >{{$store->description}} </textarea>
                         
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