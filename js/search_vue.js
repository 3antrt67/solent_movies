var app = new Vue({
	el: '#movies',
	data:{
		showEditModal: false,
		showCommentModal: false,
		errorMessage: "",
		successMessage: "",
		search: {keyword: ""},
		movies: [],
		comments: [],
		noMovie: false,
		clickPage: {}
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
			var movForm = app.toFormData(app.clickPage);
			axios.post('search_auth.php?movie=modify', movForm)
					.then(function(response) {
						console.log(response);
						app.clickPage = {};
						if(response.data.error) {
							app.errorMessage = response.data.message;
						}
						else {
							app.successMessage = response.data.message;
						}
					});
		},
		deleteFilm() {
			var movForm = app.toFormData(app.clickPage);
			axios.post('delete_page.php', movForm)
					.then(function(response) {
						app.clickPage = {};
						if(response.data.error) {
							app.errorMessage = response.data.message;
						}
						else {
							app.successMessage = response.data.message;
						}
					});
		},

		addComment() {
			var movForm = app.toFormData(app.clickPage);
			axios.post('process/add_comment.php', movForm)
					.then(function(response) {
						app.clickPage = {};
						if(response.data.error) {
							app.errorMessage = response.data.message;
						}
						else {
							app.successMessage = response.data.message;
						}
					});
		},

		getComments() {
			var movForm = app.toFormData(app.clickPage);
			axios.post('process/get_comments.php', movForm)
					.then(function(response) {
						if(response.data.error) {
							console.log(response.data);
						}
						else {
							app.comments = response.data.comments;
							app.clickPage = {};
						}
					});
		},

		selectMovie(movie){
			app.clickPage = movie;
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