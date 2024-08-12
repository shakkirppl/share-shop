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
                                 <h4 class="card-title">New User</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('user.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
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
                  <form class="form-sample"  action="{{ route('user.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">
                        
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Name" name="name" required="true"  value="{{old('name')}}"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Rol </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="rol_id" name="rol_id">
                          @foreach($rol as $rol)
                      <option value="{{$rol->id}}">{{$rol->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Department </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="department_id" name="department_id">
                          @foreach($department as $depart)
                      <option value="{{$depart->id}}">{{$depart->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Designation </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="designation_id" name="designation_id">
                          @foreach($designation as $desi)
                      <option value="{{$desi->id}}">{{$desi->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> E-mail</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="User email" name="email" id="email" required="true" value="{{old('email')}}" autocomplete="new-password"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Password</label>
                          <div class="col-sm-9">
                            <input id="password" type="text" class="form-control" name="password"  required="true"  />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Confirm Password</label>
                          <div class="col-sm-9">
                            <input id="password" type="text" class="form-control" name="password_confirmation" required="true"/>
                          </div>
                        </div>
                      </div>
   
                      </div>

                      @if($store->no_of_users>$user_count)
                <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i>


</button>
                    </div>
                    @else
                    <div class="col-md-6">
                                 <h4 class="card-title">User's Allready Exceeded</h4>
                        </div>
                    @endif
                    
                    
                    
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