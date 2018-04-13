var app = new Vue({
	el: '#movies',
	data:{
		showEditModal: false,
		errorMessage: "",
		successMessage: "",
		search: {keyword: ""},
		movies: [],
		noMovie: false,
		clickMember: {}
	},
 
	//mounted: function(){
		//this.getMovies();
	//},
 
	methods:{
		searchMonitor: function() {
			var keyword = app.toFormData(app.search);
			axios.post('search_vue.php?action=search', keyword)
					.then(function(response) {
						app.movies = response.data.movies;

						if(response.data.movies == '') {
							app.noMovie = true;
						}
						else {
							app.noMovie = false;
						}
					});
		},
		getMovies: function(){
			axios.get("dbo_connect.php")
				.then(function(response){
					console.log(response);
					app.movies = response.data.movies;
                })
                .catch(function (error) {
                    console.log(error);
                });
		},

		updateFilm() {
			var movForm = app.toFormData(app.clickMember);
			axios.post('search_auth.php?movie=modify', movForm)
					.then(function(response) {
						console.log(response);
						app.clickMember = {};
						if(response.data.error) {
							app.errorMessage = response.data.message;
						}
						else {
							app.successMessage = response.data.message;
						}
					});
		},

		selectMember(member){
			app.clickMember = member;
		},
		
		toFormData: function(obj) {
			var form_data = new FormData();
			for(var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		},

		clearMessage: function() {
			app.errorMessage = '';
			app.successMessage = '';
		}


	}
});