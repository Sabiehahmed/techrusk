@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeAppearance'=>true])
@stop

@section('footer')
    @include('admin.partials.footer')
@stop

@section('styles')
  <link href="{{ asset('/backend/assets/plugins/nestable/jquery.nestable.css')}}" rel="stylesheet">
  <link href="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">

   <style type="text/css" media="screen">
    .input-field-title {
    height: 50px !important;
    background-color: rgb(255, 255, 255) !important;
    color: black;
    border-radius: 0px !important;
    border: 2px solid rgba(0, 0, 0, 0.34) !important;

    }

    #categories_table_filter{
      display: none;
    }

    .dropzone {
    min-height: 152px !important;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    border-radius: 6px;
    padding: 0px 6px;
    }

    .dropzone .dz-message {
    font-size: 25px;
    }
   </style>
@stop

@section('scripts')
<script src="{{ asset('/backend/assets/plugins/nestable/jquery.nestable.js')}}"></script>
  <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

 <script type="text/javascript">
     

$(function() {

      $('#categories_table').dataTable({
          paging: false,
          "lengthChange": false,
           "info":     false
        });


  $('#blog_menu').nestable({ 
    dropCallback: function(details) {
       
       var order = new Array();
       $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
         order[index] = $(elem).attr('data-id');

       });
       if (order.length === 0){
        var rootOrder = new Array();
        $("#asmani_menu > ol > li").each(function(index,elem) {
          rootOrder[index] = $(elem).attr('data-id');
        });
       }

       

       $.post('{{url("admin/menu/")}}', 
       
        { 
          source : details.sourceId, 
          destination: details.destId, 
          order:JSON.stringify(order),
          rootOrder:JSON.stringify(rootOrder),
          _token:'{{csrf_token()}}'
        }, 
        function(data) {
         console.log('data '+data); 
        })
       .done(function() { 
          $( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
       })
       .fail(function() {  })
       .always(function() {  });


     }
   });



  $('.delete_toggle').each(function(index,elem) {
      $(elem).click(function(e){
        e.preventDefault();
        $('#postvalue').attr('value',$(elem).attr('rel'));
        $('#deleteModal').modal('toggle');
      });
  });
});



 </script>



@stop

@section('content')
    
   <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Menu Manager</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#"> Appearance</a></li>
                    <li class="active">Menu Manager</li>
                </ol>
            </div>
        </div>

  

        <div class="row">
      

      <div class="col-sm-4">

              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Add Menu Item</h3></div>
                    <div class="panel-body">

                        @include('admin.partials.errors')


                        <div class="form">
                            <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/menu/new')}}" >
                            {!! csrf_field() !!}
                             <div class="form-group">
                                <label for="title" class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-10">
                                <input type="text" name="title" value="" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="label" class="col-lg-2 control-label">Label</label>
                                <div class="col-lg-10">
                                   <input type="text" name="label" value="" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-lg-2 control-label">URL</label>
                                <div class="col-lg-10">
                                 <input type="text" name="url" value="" placeholder="" class="form-control">
                                </div>
                            </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- .form -->
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                   <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Add Menu From Category</h3></div>
                    <div class="panel-body">

                        @include('admin.partials.errors')


                        <div class="form">
                            <form class="cmxform form-horizontal tasi-form" id="category_form" method="post" action="{{url('/admin/menu/category')}}" >
                            {!! csrf_field() !!}

                             <div class="form-group">
                               
                                <div class="col-lg-12">
                                  

             
                
                 <div class="panel-body no-margn nicescroll" style="max-height: 200px">
                
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" name="search_category" id="category_search" class="form-control" placeholder="Search">
                  </div>
                </div>
                        <table class="table table-striped table-bordered"  id="categories_table">
                        <thead>
                          <tr>
                              <th>List</th>
                              
                          </tr>
                        </thead>
                        <tbody  >

                        @foreach($categories as $category)
                        <tr>
                        
                          <td>
                            
                           <div class="checkbox checkbox-info checkbox-circle"><input id="{{$category->id}}" type="checkbox"  name="categories[]" value="{{$category->id}}">
                           <label for="{{$category->id}}">{{$category->title}}</label>
                           </div>
                         
                          </td>

                           
                        </tr>
                      
                       
                       @endforeach
                       </tbody>
                     
                        </table>


                 </div>
             
              
           
                                
                            </div>
                            </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-info waves-effect waves-light" type="submit">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- .form -->
                    </div>
                    <!-- panel-body -->
                </div>
                <!-- panel -->
                </div>
              </div>
                
       </div>

            
             <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Main Menu Editor</h3></div>
                                <div class="panel-body">
                                @include('admin.partials.errors')
                                  @include('admin.partials.success')
                                    <div class="dd" id="blog_menu">
                                        {!! $menu !!}
                                    </div>
                                     <p id="success-indicator" style="display:none; margin-right: 10px;">
                                      <span class="fa fa-check"></span> Menu order has been saved
                                    </p>
                                </div>
                            </div>
              </div>
        </div>
        <!-- End Row -->
    </div>



  <!-- Delete item Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
          <form action="{{url('/admin/menu/delete')}}" method="POST" class="form form-inline" >
            {!! csrf_field() !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Provide details of the new menu item</h4>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this menu item?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <input type="hidden" name="delete_id" id="postvalue" value="" />
            <input type="submit" class="btn btn-danger" value="Delete Item" />
          </div>
          </form>
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
@stop