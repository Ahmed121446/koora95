	
	$(document).ready(function(){
		$.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

			$('tbody').find('.element').find('.edit').on('click', function(event) {
				event.preventDefault();

				var team_id = event.target.parentNode.parentNode.dataset['teamid'];
				var name = event.target.parentNode.parentNode.childNodes[3].innerText;
	        	var type =event.target.parentNode.parentNode.childNodes[5].innerText;
	        	var Stadium =event.target.parentNode.parentNode.childNodes[7].innerText;
	        	var country =event.target.parentNode.parentNode.childNodes[9].innerText;

				
				$('.modal').modal('show');

	       		$(".modal-body #team_name").val( name );
	       		$(".modal-body #type_id").val( type );
	       		$(".modal-body #Stadium").val( Stadium );
	       		$(".modal-body #country_id").val( country );

	       		

	       		$("button").click(function(){
	       			$.ajaxSetup({
					  headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					$.ajax({
					    data: {
					    	team_name: $(".modal-body #team_name").val(),
					    	type_id: $(".modal-body #type").val(),
					    	stadium: $(".modal-body #Stadium").val(),
					    	country_id: $(".modal-body #countries").val()	
					    },
					    url: "/teams/update/"+team_id,
					    type: 'POST',
					    success: function(response){
					        console.log(response);
					    }
					});

					$('.modal').modal('hide');
					setTimeout(function() {
						location.reload();
					}, 300);
					
				});


		});
    });