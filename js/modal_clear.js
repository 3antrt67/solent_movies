function clear_form() {
		document.getElementById("name").value="";
		document.getElementById("message").value="";
	}
	
function show_modal(){
	  $('#thanksModal').modal('show');
	}
	
function register_modal(){
		$('#loginModal').modal('hide');
		$('#registerModal').modal('show');
}