@if(isset($approveUrl))
<a href="#"   data-toggle="tooltip" data-placement="top" title="Approve {{$subject}}" onclick="


 		swal({   
            title: 'Are you sure?',   
            text: 'You want to approve this {{$subject}}?!',   
            type: 'info',   
            showCancelButton: true,   
            confirmButtonColor: '#DD6B55',   
            confirmButtonText: 'Yes, Approve it!',   
            closeOnConfirm: false 
        }, function(){   

        	//Promt
            swal('Deleted!', 'Your {{$subject}} has been Approved.', 'success'); 

			var f = document.createElement('form');
			f.setAttribute('method','post');
			f.setAttribute('action','{{$approveUrl}}');
			var i = document.createElement('input'); 
			i.setAttribute('type','hidden');
			i.setAttribute('name','_method');
			i.setAttribute('value','PATCH');
			var s = document.createElement('input'); 
			s.setAttribute('type','hidden');
			s.setAttribute('name','_token');
			s.setAttribute('value','<?php echo csrf_token(); ?>');
			f.appendChild(i);
			f.appendChild(s);
			f.submit();

			 });

 "><i class=" text-success md   md-check-box"></i></a>
@endif