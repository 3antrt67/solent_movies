var act = new Vue({
    el: '#actors',
    data:{
        showActorModal: false,
        errorMessage: "",
        successMessage: "",
        search: {keyword: ""},
        actors: [],
        noActor: false,
        clickPage: {}
    },

    methods:{
        searchActor: function() {
            var keyword = act.toFormData(act.search);
            axios.post('search_actor.php?action=search', keyword)
                    .then(function(response) {
                        act.actors = response.data.actors;

                        if(response.data.actors == '') {
                            act.noActor = true;
                        }
                        else {
                            act.noActor = false;
                        }
                    });
        },
        updateActor() {
            var actForm = act.toFormData(act.clickPage);
            axios.post('modify_actor.php?actor=modify', actForm)
                    .then(function(response) {
                        act.clickPage = {};
                        if(response.data.error) {
                            act.errorMessage = response.data.message;
                        }
                        else {
                            act.successMessage = response.data.message;
                        }
                    });
        },

        selectActor(actor){
            act.clickPage = actor;
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
        }


    }
});