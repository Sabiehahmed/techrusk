

@if(isset($additionalFields))

<a href="{{$additionalFields['url']}}"   data-toggle="tooltip" data-placement="top" title="{{$additionalFields['text']}}"><i  class="md-icon material-icons">{{$additionalFields['icon']}}</i></a>

@endif

@if(isset($additionalField2))

<a href="{{$additionalField2['url']}}"    data-toggle="tooltip" data-placement="top" title="{{$additionalField2['text']}}"><i  class="md-icon material-icons">{{$additionalField2['icon']}}</i></a>

@endif

@if(isset($viewUrl))
<a href="{{$viewUrl}}"   data-toggle="tooltip" data-placement="top" title="View {{$subject}}"><i class="md md-remove-red-eye"></i></span></a>
@endif

@if(isset($editUrl))
<a href="{{$editUrl}}"   data-toggle="tooltip" data-placement="top" title="Edit {{$subject}}"><i class="md md-mode-edit"></i></a>
@endif

@if(isset($editModalId))
<a href="#{{$editModalId}}_edit"  data-toggle="modal" title="Edit {{$subject}}" data-target="#{{$editModalId}}_edit"><i class="md md-mode-edit"></i></a>

<div id="{{$editModalId}}_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Edit {{$subject}}" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content">

        	<form action="{{$editModalUrl}}" method="POST" class="form form-inline" >
        		{!! csrf_field() !!}
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit {{$subject}}</h4></div>
            <div class="modal-body">



                @if(isset($editField1))
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="{{$editField1['name']}}" class="control-label">{{$editField1['title']}}</label> <br>


                            @if($editField1['type'] == 'text')
                            <input type="text" name="{{$editField1['name']}}" class="form-control" id="{{$editField1['name']}}" value="{{$editField1['value']}}" >
                            @endif

                        </div>
                    </div>
                </div>
                @endif


                @if(isset($editField2))
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="{{$editField2['name']}}" class="control-label">{{$editField2['title']}}</label> <br>


                            @if($editField2['type'] == 'text')
                            <input type="text" name="{{$editField2['name']}}" class="form-control" id="{{$editField2['name']}}" value="{{$editField2['value']}}" >
                            @endif


                        </div>
                    </div>
                </div>
                @endif


                @if(isset($editField3))
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="{{$editField3['name']}}" class="control-label">{{$editField3['title']}}</label> <br>

                            @if($editField3['type'] == 'text')
                            <input type="text" name="{{$editField3['name']}}" class="form-control" id="{{$editField3['name']}}" value="{{$editField3['value']}}" >
                            @endif

                            @if($editField3['type'] == 'dropdown')
                            
                             <select name="{{$editField3['name']}}" class="form-control" id="{{$editField3['name']}}"  >
                                <option value="0" >Not Any!</option>
                            @foreach($editField3['data'] as $category)
                                
                                <option value="{{$category->id}}" @if($editField3['value'] == $category->id) selected="selected" @endif>{{$category->title}}</option>


                            @endforeach
                             </select>

                            @endif

                        </div>
                    </div>
                </div>
                @endif

                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endif

@if(isset($deleteUrl))
<a href="#"   data-toggle="tooltip" data-placement="top" title="Delete {{$subject}}" onclick="


 		swal({   
            title: 'Are you sure?',   
            text: 'You will not be able to recover this {{$subject}}!',   
            type: 'warning',   
            showCancelButton: true,   
            confirmButtonColor: '#DD6B55',   
            confirmButtonText: 'Yes, delete it!',   
            closeOnConfirm: false 
        }, function(){   

        	//Promt
            swal('Deleted!', 'Your {{$subject}} has been deleted.', 'success'); 

			var f = document.createElement('form');
			f.setAttribute('method','post');
			f.setAttribute('action','{{$deleteUrl}}');
			var i = document.createElement('input'); 
			i.setAttribute('type','hidden');
			i.setAttribute('name','_method');
			i.setAttribute('value','DELETE');
			var s = document.createElement('input'); 
			s.setAttribute('type','hidden');
			s.setAttribute('name','_token');
			s.setAttribute('value','<?php echo csrf_token(); ?>');
			f.appendChild(i);
			f.appendChild(s);
			f.submit();

			 });

 "><i class=" text-danger md  md-delete"></i></a>
@endif

