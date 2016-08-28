@if(isset($deleteAllUrl))
<a href="#"   class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete {{$subject}}" onclick="


 		swal({   
            title: 'Are you sure you want to delete All {{$subject}} ?',   
            text: 'You will not be able to recover All {{$subject}}!',   
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
			f.setAttribute('action','{{$deleteAllUrl}}');
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

 "><i class=" text-danger md  md-delete"></i>   Delete All</a>
@endif