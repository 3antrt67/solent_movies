var act = new Vue({
    el: '#createActor',

    data: {
        errorMessage: "",
        successMessage: "",
        actor: {
            name: '',
            profile: '',
            age: '',
            bio: ''
        }
    },

    methods: {
        createPage: function() {
            var actPage = act.toFormData(act.actor);
            axios.post('create_actor.php', actPage)
                    .then(function(response) {
                        if(response.data.error) {
                            act.errorMessage = response.data.message;
                        }
                        else {
                            act.successMessage = response.data.message;
                        }
                    });
        },

        toFormData: function(obj) {
            var form_data = new FormData();
            for(var key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
        
        clearMessage: function() {
			act.errorMessage = '';
			act.successMessage = '';
        },
    }
});