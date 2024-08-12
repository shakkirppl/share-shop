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
                                 <h4 class="card-title">Update User</h4>
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
                  <form class="form-sample"  action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                          @method('PUT')
                    <div class="row">
                        
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Name" name="name" value="{{$user->name}}"   />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Rol </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="rol_id" name="rol_id">
                          @foreach($rol as $rol)
                          @if($rol->id==$user->rol_id)
                          <option selected value="{{$rol->id}}">{{$rol->name}}</option>
                          @else
                      <option value="{{$rol->id}}">{{$rol->name}}</option>
                      @endif
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> E-mail</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" placeholder="User email" name="email" value="{{$user->email}}"   />
                          </div>
                        </div>
                      </div>
                      <!--<div class="col-md-12">-->
                      <!--  <div class="form-group row">-->
                      <!--    <label class="col-sm-2 col-form-label required"> Password</label>-->
                      <!--    <div class="col-sm-9">-->
                      <!--      <input id="password" type="text" class="form-control" name="password"  value="{{$user->password}}"  />-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--</div>-->
                      <!--<div class="col-md-12">-->
                      <!--  <div class="form-group row">-->
                      <!--    <label class="col-sm-2 col-form-label required"> Confirm Password</label>-->
                      <!--    <div class="col-sm-9">-->
                      <!--      <input id="password" type="password" class="form-control" name="password_confirmation"  value="{{$user->password}}"  />-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--</div>-->
             
          
     

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