(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer', 'mainCtrl', 'commentService', 'articleService', 'validation.match'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider) {

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $authProvider.loginUrl = '/api/authenticate';
            $authProvider.signupUrl = '/api/register';

            // Redirect to the auth state if any other states
            // are requested other than users
            $urlRouterProvider.otherwise('/feed');
            
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'views/auth/loginView.html',
                })
                .state('register', {
                    url: '/register',
                    templateUrl: 'views/auth/registerView.html',
                })
                .state('users', {
                    url: '/users',
                    templateUrl: 'views/userView.html',
                    controller: 'UserController as user'
                })
                .state('feed', {
                    url: '/feed',
                    templateUrl: 'views/feedView.html',
                    controller: 'mainController as feed'
                });
        });
})();