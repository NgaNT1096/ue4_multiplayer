@extends('admin.Layout.index')

@section('content')
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Model3d
                            <small>List</small>
                     </h1>
                    </div>
                   
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
						<table class="col-lg-7 table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr align="center">
									<th>ID</th>
									<th>Name</th>
									<th>Link Model 3D</th>   
									<th>Download</th>
								</tr>
							</thead>
							<tbody>

						@foreach($models as $model)
							<tr>
								<td>{{$model->id}}</td>
								<td>{{$model->name}}</td>
								<td>{{$model->link_model}}</td>
								
								<td>
								<a href="download/{{$model->link_model}}" download="{{$model->link_model}}">
									<button type="button" class="btn btn-primary">
									<i class="glyphicon glyphicon-download">
										Download
									</i>
									</button>
								</a>
								</td>
							</tr>
						@endforeach
						</tbody>
						</table>
                    </div>
					
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection