angular
	.module('authApp')
	.directive('toolbar', myToolbar);

	function myToolbar(){
		return{
			templateUrl: 'views/toolbar.tpl.html',
			controller: toolbarController,
			controllerAs: 'auth'
		}
	}

	function toolbarController($auth, $location, $state){

		var vm = this;

		vm.login = function() {

			var loginCredentials = {
                email: vm.email,
                password: vm.password
            };
            
            // Use Satellizer's $auth service to login
            $auth.login(loginCredentials)
                .then(function(data) {
                    // If login is successful, redirect to the users state
                    console.log('login success!');
                    console.log(data);
                    $state.go('feed');
                    clearInput();
                })
                .catch(function(response){
                    // Handle errors here, such as displaying a notification
                    // for invalid email and/or password.
                    console.log(response);
                });

		};

		vm.register = function(){

            var registerCredentials = {
                name: vm.name,
                dob: vm.dob,
                email: vm.email,
                password: vm.password,
                password_confirmation: vm.password_confirmation
            }

            $auth.signup(registerCredentials)
                .then(function(data) {
                    // If login is successful, redirect to the users state
                    console.log('signup success!');
                    $auth.setToken(data);
                    $state.go('feed');
                    clearInput();
                })
                .catch(function(response){
                    // Handle errors here, such as displaying a notification
                    // for invalid email and/or password.
                    vm.error = true;
                    vm.errorMessage = response.data.email[0];
                });

            
        };

        vm.isAuthenticated = function() {
            return $auth.isAuthenticated();
        };

		vm.logout = function(){
			console.log('logging out...');
            $auth.logout();
            $state.go('login');
		};

		function clearInput(){
			vm.name = "";
			vm.dob = "";
            vm.email = "";
            vm.password = "";
            vm.password_confirmation = "";
		};
	}