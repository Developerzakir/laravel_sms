@extends('admin.admin_master')

@section('backend')
<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
    

      <!-- Main content -->
      <section class="content">
        <div class="row">
            
       

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">User Lists</h3>
                <a href="{{route('users.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add User</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Roll</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ( $allData as $key=> $user)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$user->usertype}}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->email}}</td>
                              <td>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('users.delete',$user->id) }}" id="delete" class="btn btn-danger btn-sm">Delete</a>
                              </td>
                          </tr>
                          @endforeach
                          
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

           
            <!-- /.box -->          
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
@endsection