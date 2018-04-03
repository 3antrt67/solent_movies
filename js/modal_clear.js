function clear_form() {
		document.getElementById("name").value="";
		document.getElementById("message").value="";
	}
	
function thanks_modal(){
	  $('#thanksModal').modal('show');
	}
	
function register_modal(){
		$('#loginModal').modal('hide');
		$('#registerModal').modal('show');
}

function poster_modal(){
		$('#createMovie').modal('show');
}

window.onload = function() {
	document.getElementById('searchMov').addEventListener('click', searchCon);
}
	
function searchCon() {
		var search = document.getElementById("search_term");
		var dataString = 'search_term=' + search.value;
		if (search.value == '') {
			alert("Please enter a film to search");
		} else {
		$.ajax({
			type: "GET",
			url: "process/search.php",
			data: dataString,
			cache: false,
			success: function(response) {
				//$("#searchResults").load(response);
				alert(response);
				$("#searchResults").html(response);
				}
			});
		} 
	return false;
}