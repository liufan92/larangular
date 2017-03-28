angular.module('mainCtrl', [])

// inject the Comment service into our controller
.controller('mainController', function($http, Comment, Article, $auth, $state) {

    if(!$auth.isAuthenticated()){
        $state.go('login');
    }

    var vm = this; 
    // object to hold all the data for the new comment form
    vm.commentData = {};

    // loading variable to show the spinning loading icon
    vm.loading = true;

    // get all the comments first and bind it to the $scope.comments object
    // use the function we created in our service
    // GET ALL COMMENTS ==============
    Comment.get()
        .then(function(data) {
            vm.comments = data.data.data;
            vm.loading = false;
        });

    Article.get()
        .then(function(data) {
            vm.articles = data.data.data;
            
            vm.loading = false;
        });

    // function to handle submitting the form
    // SAVE A COMMENT ================
    vm.submitComment = function() {
        vm.loading = true;

        // save the comment. pass in comment data from the form
        // use the function we created in our service
        Comment.save(vm.commentData)
            .then(function(data) {

                // if successful, we'll need to refresh the comment list
                Comment.get()
                    .then(function(getData) {
                        vm.comments = getData;
                        vm.loading = false;
                    });

            },
            function(data) {
                console.log(data);
            });
    };

    // function to handle deleting a comment
    // DELETE A COMMENT ====================================================
    vm.deleteComment = function(id) {
        vm.loading = true; 

        // use the function we created in our service
        Comment.destroy(id)
            .then(function(data) {

                // if successful, we'll need to refresh the comment list
                Comment.get()
                    .then(function(getData) {
                        vm.comments = getData;
                        vm.loading = false;
                    });

            });
    };

});