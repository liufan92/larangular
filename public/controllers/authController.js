angular.module('authApp')

// inject the Comment service into our controller
.controller('authController', function($auth, $state, store) {

    var vm = this;
    vm.error = false;
    vm.errorMessage = "";

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
                store.set('profile', data.data.user_info);
                $state.go('feed');
                //var user_info = store.get('profile');
                //console.log(user_info.email);
                //console.log(user_info.name);
                clearInput();
            })
            .catch(function(response){
                // Handle errors here, such as displaying a notification
                // for invalid email and/or password.
                console.log(response);
                vm.error = true;
                if(response.data.error == "invalid_credentials")
                    vm.errorMessage = "The email and password you entered did not match our records. Please double-check and try again.";
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
                console.log(data);
                $auth.setToken(data);
                $state.go('feed');
                clearInput();
            })
            .catch(function(response){
                // Handle errors here, such as displaying a notification
                // for invalid email and/or password.
                console.log(response);
                vm.error = true;
                if(response.data.email)
                    vm.errorMessage = "The email has already been taken";
                else
                    vm.errorMessage = "Error: Please check your name, email (max: 255 characters)";
            });

        
    };

    vm.isAuthenticated = function() {
        return $auth.isAuthenticated();
    };


    function clearInput(){
        vm.name = "";
        vm.dob = "";
        vm.email = "";
        vm.password = "";
        vm.password_confirmation = "";
    };

});