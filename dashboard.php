<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"/>
    <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <link rel="stylesheet prefetch" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Solent Movies Dashboard</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</head>
<body>

<div id="dash">
        <nav>
            <div class="nav-wrapper red">
                <ul>
					<li><a class="button-collapse" href="#" data-activates="mobile"><i class="material-icons">menu</i></a></li>
                    <li><a class="title">Solent Movies Dashboard</a></li>
                </ul>
				<ul class="right hide-on-med-and-down">
					<li class="active"><a href="#" v-on:click="makeActive('dashboard')"><i class="material-icons blue-text text-darken-1">dashboard</i>Dashboard</a></li>
					<li><div class="divider"></div></li>
					<li><a href="#" v-on:click="makeActive('changelog')"><i class="material-icons">settings</i>Changelog</a></li>
					<li><a href="#" v-on:click="makeActive('help')"><i class="material-icons">help</i>Help &amp; Feedback</a></li>
                </ul>
				<ul class="right">
                    <li><a href="index_auth.php"><i class="material-icons">home</i></a></li>
                </ul>
            </div>
        </nav>
    <ul class="sidenav" id="mobile" name="mobile">
        <li class="active"><a href="#" v-on:click="makeActive('dashboard')"><i class="material-icons blue-text text-darken-1">dashboard</i>Dashboard</a></li>
        <li><div class="divider"></div></li>
        <li><a href="#" v-on:click="makeActive('changelog')"><i class="material-icons">settings</i>Changelog</a></li>
        <li><a href="#" v-on:click="makeActive('help')"><i class="material-icons">help</i>Help &amp; Feedback</a></li>
    </ul>
    <div class="main" v-if="isActive('dashboard')">
        <div class="container-fluid">
            <div class="row">
                <div class="col s12 m4">
                    <div class="col s12 m12">
                            <div class="card">
                                <table class="bordered highlight">
                                    <thead>
                                        <tr>
                                            <th>Currently logged in users:</th>
                                            <th>Logged in:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users">
                                            <td>{{ user.username }}</td>
                                            <td>{{ user.last_login }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="col s12 m4">
                        <b-card header="<b>Incomplete Film Pages</b>">
                            <b-list-group v-for="movie in movies">
                                <b-list-group-item button @click="showEditModal=true; selectMovie(movie);">
                                    {{ movie.name }}
                                    <b-badge variant="primary" pill>Edit</b-badge>
                                </b-list-group-item> 
                            </b-list-group>
                        </b-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main" v-if="isActive('changelog')">
      <div class="container-fluid">
        <b-card header="<b>Recent Modifications</b>">
            <table class="bordered highlight">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Editor</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="change in changes">
                        <td>{{ change.page }}</td>
                        <td>{{ change.author }}</td>
                        <td>{{ change.time }}</td>
                    </tr>
                </tbody>
            </table>
        </b-card>
       </div>
    </div>
    <div class="main" v-if="isActive('help')">
        <div class="container-fluid">
        <div class="alert alert-danger text-center" v-if="errorMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ errorMessage }}
        </div>
        <div class="alert alert-success text-center" v-if="successMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ successMessage }}
		</div>
            <div class="row">
                <div class="col s12 m12">
                    <h2>Contact us:</h2>
                    <b-form @submit="onSubmit" @reset="onReset">
                        <b-form-group id="nameGroup"
                                      label="Name:"
                                      label-for="nameGroup">
                            <b-form-input id="nameInput"
                                          type="text"
                                          v-model="form.name"
                                          required
                                          placeholder="Enter name">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group id="emailGroup"
                                      label="Email address:"
                                      label-for="emailGroup"
                                      description="Your email will never be shared with any other parties.">
                            <b-form-input id="emailInput"
                                          type="email"
                                          v-model="form.email"
                                          required
                                          placeholder="Enter email">
                            </b-form-input>
                        </b-form-group>
                        <b-form-group id="commentGroup"
                                      label="Comments:"
                                      label-for="commentGroup">
                            <b-form-textarea id="commentInput"
                                          v-model="form.message"
                                          required
                                          placeholder="Please enter comments here"
                                          :rows="3"
                                          :max-rows="6">
                            </b-form-textarea>
                        </b-form-group>
                        <b-button type="submit" variant="primary">Submit</b-button>
                        <b-button type="reset" variant="danger">Reset</b-button>
                    </b-form>
                </div>
            </div>
        </div>
    </div>
    <b-modal id="editModal" ref="editModal" title="Edit Film Page" @ok="updateFilm()" v-model="showEditModal">
				<b-form>
	    			<b-form-group id="titleInputGroup" label="Title:" label-for="titleInput">
	        			<b-form-input id="titleInput" type="text" v-model="clickPage.name"></b-form-input>
					</b-form-group>
					<b-form-group id="posterInputGroup" label="Poster:" label-for="posterInput">
		    			<b-form-input id="posterInput" type="text" v-model="clickPage.poster"></b-form-input>
					</b-form-group>
					<b-form-group id="directorInputGroup" label="Director(s):" label-for="directorInput">
		    			<b-form-input id="directorInput" type="text" v-model="clickPage.director"></b-form-input>
					</b-form-group>
					<b-form-group id="actorInputGroup" label="Actor(s):" label-for="actorInput">
						<b-form-input id="actorInput" type="text" v-model="clickPage.actor"></b-form-input>
					</b-form-group>
					<b-form-group id="releaseInputGroup" label="Release Date:" label-for="releaseInput">
		    			<b-form-input id="releaseInput" type="text" v-model="clickPage.release_date"></b-form-input>
					</b-form-group>
					<b-form-group id="synopsisInputGroup" label="Synopsis:" label-for="synopsisInput">
		    			<b-form-input id="synopsisInput" type="text" v-model="clickPage.synopsis"></b-form-input>
					</b-form-group>
				</b-form>
    </b-modal>
                        
</div>
<script>
var dash = new Vue({
  el: '#dash',
  
  data: {
      active: 'dashboard',
      showEditModal: false,
      errorMessage: "",
      successMessage: "",
      movies: [],
      changes: [],
      users: [],
      clickPage: {},
      form: {
          name: '',
          email: '',
          comment: ''
      },
  },

  mounted: function() {
      this.getUsers();
      this.getMovies();
      this.getChanges();
  },

  methods: {
    getUsers: function() {
          axios.get("user_status.php")
              .then(function(response){
                  dash.users = response.data.users;
              })
              .catch(function(error){
                  console.log(error);
              });
      },

      getMovies: function() {
          axios.get("process/incomplete_page.php")
              .then(function(response){
                  dash.movies = response.data.movies;
              })
              .catch(function(error){
                  console.log(error);
              });
      },
	  
      getChanges: function() {
          axios.get("process/changelog.php")
              .then(function(response){
                  dash.changes = response.data.changes;
              })
              .catch(function(error){
                  console.log(error);
              });
      },

      onSubmit: function() {
          var contact = dash.toFormData(dash.form);
          axios.post('process/contact.php', contact)
                  .then(function(response) {
                      if(response.data.error) {
                          dash.errorMessage = response.data.message;
                      }
                      else {
                          dash.successMessage = response.data.message;
                      }
                  });
      },

      updateFilm() {
        var movForm = dash.toFormData(dash.clickPage);
			axios.post('search_auth.php?movie=modify', movForm)
					.then(function(response) {
						console.log(response);
						dash.clickPage = {};
						if(response.data.error) {
							dash.errorMessage = response.data.message;
						}
						else {
							dash.successMessage = response.data.message;
						}
					});
      },
      onReset: function() {
          dash.form.name = '';
          dash.form.email = '';
          dash.form.comment = '';
      },

      toFormData: function(obj) {
			var form_data = new FormData();
			for(var key in obj) {
				form_data.append(key, obj[key]);
			}
			return form_data;
	    },

      selectMovie(movie){
          dash.clickPage = movie;
      },

      makeActive: function(item){   
         this.active = item;
         console.log(this.active); 
      }, 
      
      isActive: function(name) {
         if (name === this.active)
           return true;
         return false;
      },

      clearMessage: function() {
			dash.errorMessage = '';
			dash.successMessage = '';
		}
  }
  
});
$(document).ready(function() {
    $('.sidenav').sidenav();
});
</script>