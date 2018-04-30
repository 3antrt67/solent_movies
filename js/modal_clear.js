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

$('#createActor').modal('show')
$('#createMovie').modal('show')

function getFilm() {
	//var film = document.getElementById("filmPage");
	//var res = $("#filmPage").find("h2");
	//console.log(res);
	var res = $('.searchRes').find("h2");
	console.log(res);
	for (i = 0; i < res.length; i++) {
		var fin = res[i].innerText;
	}	
	alert('The film is -' + fin);
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
				alert(response);
				$("#searchResults").html(response);
				}
			});
		} 
	return false;
}