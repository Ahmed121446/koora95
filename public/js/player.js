	$(document).ready(function(){
		$.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

			$('tbody').find('.element').find('.edit').on('click', function(event) {
				event.preventDefault();

				var playerid = event.target.parentNode.parentNode.dataset['playerid'];
				var name = event.target.parentNode.parentNode.childNodes[3].innerText;
	        	var position =event.target.parentNode.parentNode.childNodes[5].innerText;
	        	var Team =event.target.parentNode.parentNode.childNodes[7].innerText;
	        	var country =event.target.parentNode.parentNode.childNodes[9].innerText;

				
				$('.modal').modal('show');

	       		$(".modal-body #player_name").val( name );
	       		$(".modal-body #player_position").val( position );

	       		$(".modal-body #team_id option").each(function()
				{
				    if($(this).text() == Team){
				    	$(".modal-body #team_id").val($(this).val());
				    }
				});

				$(".modal-body #country_id option").each(function()
				{
				    if($(this).text() == country){
				    	$(".modal-body #country_id").val($(this).val());
				    }
				});

	       		

	       		$("#Update").click(function(){
	       			$.ajaxSetup({
					  headers: {
					    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
					});
					$.ajax({
					    data: {
					    	player_name: $(".modal-body #player_name").val(),
					    	player_position: $(".modal-body #player_position").val(),
					    	team_id: $(".modal-body #team_id").val(),
					    	country_id: $(".modal-body #country_id").val()	
					    },
					    url: "/players/update/"+playerid,
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