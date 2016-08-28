@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeMedia'=>true])
@stop

@section('footer')
    @include('admin.partials.footer')
@stop

@section('styles')
    <link href="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

  <script>

    // Confirm file delete
    function delete_file(name) {
      $("#delete-file-name1").html(name);
      $("#delete-file-name2").val(name);
      $("#modal-file-delete").modal("show");
    }

    // Confirm folder delete
    function delete_folder(name) {
      $("#delete-folder-name1").html(name);
      $("#delete-folder-name2").val(name);
      $("#modal-folder-delete").modal("show");
    }

    // Preview image
    function preview_image(path) {
      $("#preview-image").attr("src", path);
      $("#modal-image-view").modal("show");
    }

    // Startup code
      $(document).ready(function() {
            $('#media_datatable').dataTable();
        });
  </script>
@stop


@section('content')
    
   <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Media Library</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#">Media</a></li>
                    <li class="active">Listing</li>
                </ol>
            </div>
        </div>
        
          <div class="row" style="margin-bottom:10px;">
                        <div class="col-md-6">
                            <button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#modal-folder-create">  <i class="fa fa-plus-circle"></i> New Folder</button>

                            <button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#modal-file-upload"><i class="fa fa-upload"></i> Upload</button>
                        </div>
          </div>
  

        <div class="row">
      
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Files List</h3></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table id="media_datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                         <th>Name</th>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Size</th>
                                          <th data-sortable="false">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    {{-- The Subfolders --}}
                                    @foreach ($subfolders as $path => $name)
                                      <tr>
                                        <td>
                                          <a href="/admin/upload?folder={{ $path }}">
                                            <i class="fa fa-folder fa-lg fa-fw"></i>
                                            {{ $name }}
                                          </a>
                                        </td>
                                        <td>Folder</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                          <button type="button" class="btn btn-xs btn-danger"
                                                  onclick="delete_folder('{{ $name }}')">
                                            <i class="fa fa-times-circle fa-lg"></i>
                                            Delete
                                          </button>
                                        </td>
                                      </tr>
                                    @endforeach

                                    {{-- The Files --}}
                                    @foreach ($files as $file)
                                      <tr>
                                        <td>
                                          <a href="{{ $file['webPath'] }}">
                                            @if (is_image($file['mimeType']))
                                              <i class="fa fa-file-image-o fa-lg fa-fw"></i>
                                            @else
                                              <i class="fa fa-file-o fa-lg fa-fw"></i>
                                            @endif
                                            {{ $file['name'] }}
                                          </a>
                                        </td>
                                        <td>{{ $file['mimeType'] or 'Unknown' }}</td>
                                        <td>{{ $file['modified']->format('j-M-y g:ia') }}</td>
                                        <td>{{ human_filesize($file['size']) }}</td>
                                        <td>
                                          <button type="button" class="btn btn-xs btn-danger"
                                                  onclick="delete_file('{{ $file['name'] }}')">
                                            <i class="fa fa-times-circle fa-lg"></i>
                                            Delete
                                          </button>
                                          @if (is_image($file['mimeType']))
                                            <button type="button" class="btn btn-xs btn-success"
                                                    onclick="preview_image('{{ $file['webPath'] }}')">
                                              <i class="fa fa-eye fa-lg"></i>
                                              Preview
                                            </button>
                                          @endif
                                        </td>
                                      </tr>
                                    @endforeach



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
     @include('admin.upload._modals')
@stop