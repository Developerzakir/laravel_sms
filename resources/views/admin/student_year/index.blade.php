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
                <h3 class="box-title">Student Year Lists</h3>
                <a href="{{route('student.year.add')}}" style="float:right;" class="btn btn-rounded btn-success mb-5">Add Student Year</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ( $allData as $key=> $studentyear)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$studentyear->name}}</td>
                              <td>
                                <a href="{{ route('student.year.edit',$studentyear->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('student.year.delete',$studentyear->id) }}" id="delete" class="btn btn-danger btn-sm">Delete</a>
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