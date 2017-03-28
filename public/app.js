(function() {

    'use strict';

    angular
        .module('authApp', ['ui.router', 'satellizer', 'mainCtrl', 'commentService', 'articleService', 'validation.match', 'angular-storage'])
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
                    controller: 'authController as auth'
                })
                .state('register', {
                    url: '/register',
                    templateUrl: 'views/auth/registerView.html',
                    controller: 'authController as auth'
                })
                .state('users', {
                    url: '/users',
                    templateUrl: 'views/userView.html',
                    controller: 'userController as user'
                })
                .state('feed', {
                    url: '/feed',
                    templateUrl: 'views/feedView.html',
                    controller: 'mainController as feed'
                });
        });
})();