var vm = new Vue({
    el: '#recentlyAdded',
    data:{
        showEditModal: false,
        errorMessage: "",
		successMessage: "",
        movies: [],
        clickPage: {}
    },

    mounted: function() {
            axios.get("recent_movies.php")
                .then(function(response) {
                    vm.movies = response.data.movies;
                });
    },

    methods:{
        updateFilm() {
			var movForm = vm.toFormData(vm.clickPage);
			axios.post('search_auth.php?movie=modify', movForm)
					.then(function(response) {
						console.log(response);
						vm.clickPage = {};
						if(response.data.error) {
							vm.errorMessage = response.data.message;
						}
						else {
							vm.successMessage = response.data.message;
						}
					});
        },
        
        selectMovie(movie){
			vm.clickPage = movie;
		},
		
		toFormData: function(obj) {
			var form_data = new FormData();
			for(var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
		}
    }
});