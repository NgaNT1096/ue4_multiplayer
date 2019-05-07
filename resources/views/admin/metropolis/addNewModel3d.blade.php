@extends('admin.Layout.index')

@section('content')
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Content
                            <small>Add</small>
                     </h1>
                    </div>
                   
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}} <br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>                       
                        @endif
                        <form id="form_add_content" action="admin/metropolis/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" >
                            <div class="form-group">
                                <label>Name model:</label>
                                <input id="name" class="form-control" name="name" placeholder="Please Enter name" />
                            </div>
                            <div class="form-group">
                                <label>Upload Image preview</label>
                                <input id="image" type="file" name="image" onchange="readURL(this);" accept="image/*">
                                <img id="imgpreview" src="" alt="your image" />
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <div class="dropdown">
                                     <select id="type" class="btn btn-default dropdown-toggle"  name="type" type="button" data-toggle="dropdown">
                                          <option value="fbx"> FBX </option>
                                          <option value="obj"> OBJ </option>
                                     </select>
                                </div>   
                            </div>                      
                            <div class="form-group">
                                <label>Upload Model 3d</label>
                                <input id="link_model" type="file" onclick="getTypeData();" name="link_model" accept="">
                            </div>
                            <button type="submit" class="btn btn-default" id="btn_submit" value='Load' >Upload</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
<script>
    function getTypeData(){
        var type = document.getElementById("type");
        var value_type = type.options[type.selectedIndex].value;

        if(value_type == 'fbx'){
            document.getElementById("link_model").accept = ".fbx , .zip , .rar";
        }else{
            document.getElementById("link_model").accept = ".obj , .zip , .rar";
            console.log(value_type);
        }
    }
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgpreview')
                        .attr('src', e.target.result);
                    $('#imgpreview').width(300);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endsection