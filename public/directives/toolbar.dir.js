angular
	.module('authApp')
	.directive('toolbar', myToolbar);

	function myToolbar(){
		return{
			templateUrl: 'views/toolbar.tpl.html',
			controller: toolbarController,
			controllerAs: 'toolbar'
		}
	}

	function toolbarController($auth, $state, store){
        var vm = this;

        vm.logout = function(){
            console.log('logging out...');
            store.remove('profile');
            $auth.logout();
            $state.go('login');
        };

        vm.isAuthenticated = function(){
            return $auth.isAuthenticated();
        }
	}