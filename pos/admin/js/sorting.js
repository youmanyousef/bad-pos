$(document).ready(function(){
	let sort_arr = ["id", "time_start", "time_end", "phone", "name", "email", "type", "service", "notes"];
	
	for (let i = 0; i<sort_arr.length; i++) {
		id = '#'+sort_arr[i];
		if (window.location.href.indexOf("?sort="+sort_arr[i]+"&order=DESC") > -1) {
			$(id).attr('href',"?sort="+sort_arr[i]+"&order=ASC");
		} else {
			$(id).attr('href',"?sort="+sort_arr[i]+"&order=DESC");
		}
	}
	
});