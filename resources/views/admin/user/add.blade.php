@extends('admin.admin_master')

@section('backend')

<div class="content-wrapper">
    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
             <div class="box">
               <div class="box-header with-border">
                 <h4 class="box-title">Add User</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                 <div class="row">
                   <div class="col">
                       <form method="POST" action="{{route('users.store')}}">
                        @csrf 
                         <div class="row">
                            <div class="col-12">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Role<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="usertype" id="select" required="" class="form-control">
                                                <option value="" selected disabled>Select Role</option>
                                                <option value="Admin">Admin</option>
                                                <option value="User">User</option>
                                            </select>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required"> 
                                         </div>
                                     
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" required="" data-validation-required-message="This field is required"> 
                                         </div>
                                     
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> 
                                         </div>
                                     
                                    </div>
                                </div>
                              </div>
                              
                            </div>
                         </div>


                           <div class="text-xs-right">
                               <input type="submit" value="submit" class="btn btn-rounded btn-info mb-5">
                           </div>
                       </form>
   
                   </div>
                   <!-- /.col -->
                 </div>
                 <!-- /.row -->
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
   
           </section>
    </div>
</div>

@endsection