$(document).ready(function() {
	loadDescription = function() {
		// Grab the ID from the cuurrent div
		var project_id = $('div.slick-active').attr('id');
		// Call an ajax file which will return the necessary data
		$.post('ajax.php?get_project_data', {project_id: project_id}, function(data) {
			if (!data.error) {
				var description = '';
				description += '<div class="title">' + data.name + '</div><br />';
				description += data.description + '<br /><br />';
				description += '<span class="details">Project Details</span><br />';
				description += '<ul>';
				for (i=0; i< data.details.length; i++) {
					description += '<li>' + data.details[i] + '</li>';
				}
				description += '</ul>';
				if (data.url != '') {
					description += '<br /><div><a href="' + data.url + '" target=_blank">View Interactive Sample</a></div>';
				}
				$('div#player_description').html(description)
			}
		}, 'json');

		return false;
	}

	$('div#player').slick({
  		dots: true,
  		speed: 500,
		infinite: false,
		onInit: loadDescription,
		onAfterChange: loadDescription
	});
});