	function season_stages(season_id) {
		document.getElementById("stages").innerHTML = "\
		<option value='0'>All</option>";
		
		if(season_id != 0){
			$.get('/stages', {season_id: season_id}, function(stages) {
				for (stage in stages) {
					document.getElementById("stages").innerHTML +="\
					<option value="+stages[stage].id+">"+stages[stage].name+"</option>";
				}
			});
		}	
	}

	function stage_rounds(stage_id) {

		if(stage_id != 0){
			$.get('/stages/rounds', {stage_id: stage_id}, function(rounds) {
				if(rounds.length != 0){
					var roundsSelect = document.getElementById("rounds");
					roundsSelect.style.display = "inline";
					roundsSelect.innerHTML = "\
					<option value=0> All </option>";

					for (round in rounds) {
						console.log(round);
						roundsSelect.innerHTML +="\
						<option value="+rounds[round].id+">"+rounds[round].round_number+"</option>";
					}
				}
			});
		}	
	}


	
	$(document).ready(function(){
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

		$('tbody').find('.element').find('.edit').on('click', function(event) {
			event.preventDefault();
			var match_id = event.target.parentNode.parentNode.dataset['matchid'];
			var FT_Name = event.target.parentNode.parentNode.childNodes[1].innerText;
			var ST_Name =event.target.parentNode.parentNode.childNodes[3].innerText;
			var date =event.target.parentNode.parentNode.childNodes[5].innerText;
			var time =event.target.parentNode.parentNode.childNodes[7].innerText;
			var FT_Goals =  event.target.parentNode.parentNode.childNodes[11].innerText;
			var ST_Goals =  event.target.parentNode.parentNode.childNodes[13].innerText;
			var WT =  event.target.parentNode.parentNode.childNodes[15].innerText;
			var stadium =  event.target.parentNode.parentNode.childNodes[17].innerText;
			var R_cards =  event.target.parentNode.parentNode.childNodes[19].innerText;
			var Y_cards =  event.target.parentNode.parentNode.childNodes[21].innerText;
			
			$('.modal').modal('show');

			$(".modal-body #first_name").val( FT_Name );
			$(".modal-body #second_name").val( ST_Name );
			$(".modal-body #date").val( date );
			$(".modal-body #time").val( time );
			$(".modal-body #FTG").val( FT_Goals );
			$(".modal-body #STG").val( ST_Goals );
			$(".modal-body #WT").val( WT );
			$(".modal-body #stadium").val( stadium );  
			$(".modal-body #red_cards").val( R_cards );
			$(".modal-body #yellow_cards").val( Y_cards ); 


			$("button").click(function(){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					data: {
						date:$(".modal-body #date").val(),
						time:$(".modal-body #time").val(),
						FTG:$(".modal-body #FTG").val(),
						STG:$(".modal-body #STG").val(),
						winner :$(".modal-body #WT").val(),
						stadium:$(".modal-body #stadium").val(),
						red :$(".modal-body #red_cards").val(),
						yellow :$(".modal-body #yellow_cards").val(),
						
					},
					url: "/matches/update/"+match_id,
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