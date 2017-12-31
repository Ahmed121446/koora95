    $(document).ready(function()
	
	{
	
		$( "#name" ).autocomplete({
		 	source: "/players/{{$team->team->id}}/search",
			minLength: 1,
			autoFocus:true,
			select: function(event, ui) {
		  		$('#invisible').val(ui.item.id);
			}
		});
	
	});