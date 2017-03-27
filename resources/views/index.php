<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Angular-Laravel Authentication</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.css">-->
    </head>
    <body ng-app="authApp">
        <toolbar></toolbar>
        <div class="container">
            <div ui-view></div>
        </div>        

    </body>

    <!-- Application Dependencies -->
    <script src="bower_components/jquery/dist/jquery.js" ></script>
    <script src="bower_components/angular/angular.js"></script>
    <script src="bower_components/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/satellizer/dist/satellizer.js"></script>
    <script src="bower_components/angular-validation-match/dist/angular-validation-match.js"></script>

    <!-- Application Scripts -->
    <script src="app.js"></script>
    <script src="js/main.js"></script>
    <script src="controllers/authController.js"></script>
    <script src="controllers/userController.js"></script>
    <script src="directives/toolbar.dir.js"></script>
    <script src="controllers/mainController.js"></script> <!-- load our controller -->
    <script src="services/commentService.js"></script> <!-- load our service -->
    <script src="services/articleService.js"></script> <!-- load our service -->


</html>