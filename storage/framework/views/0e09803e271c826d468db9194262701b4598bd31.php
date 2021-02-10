<!DOCTYPE html>
<html>
 <head>
  <title> Welcome </title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
  <style>
  .form_style
  {
   width: 600px;
   margin: 0 auto;
  }
  </style>
  
 </head>
 <body>
  <br />
   <h3 align="center"> Register Login Script </h3>
  <br />

  <div ng-app="login_register_app" ng-controller="login_register_controller" class="container form_style">
   
   <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
    <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
    {{alertMessage}}
   </div>

   <div class="panel panel-default" ng-show="login_form">
    <div class="panel-heading">
     <h3 class="panel-title">Login</h3>
    </div>
    <div class="panel-body">
     <form method="post" ng-submit="submitLogin()">
      <div class="form-group">
       <label>Enter Your Email</label>
       <input type="text" name="email" ng-model="loginData.email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Enter Your Password</label>
       <input type="password" name="password" ng-model="loginData.password" class="form-control" />
      </div>
      <div class="form-group" align="center">
       <input type="submit" name="login" class="btn btn-primary" value="Login" />
       <br />
       <input type="button" name="register_link" class="btn btn-primary btn-link" ng-click="showRegister()" value="Register" />
      </div>
     </form>
    </div>
   </div>

   <div class="panel panel-default" ng-show="register_form">
    <div class="panel-heading">
     <h3 class="panel-title">Register</h3>
    </div>
    <div class="panel-body">
     <form method="post" ng-submit="submitRegister()">
      <div class="form-group">
       <label>First Name</label>
       <input type="text" name="first_name" ng-model="registerData.first_name" class="form-control" />
      </div>
	   <div class="form-group">
       <label>Last Name</label>
       <input type="text" name="last_name" ng-model="registerData.last_name" class="form-control" />
      </div>
      <div class="form-group">
       <label>Email</label>
       <input type="text" name="email" ng-model="registerData.email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="password" ng-model="registerData.password" class="form-control" />
      </div>
	  <div class="form-group">
            <label for="password_confirmation">Password Confirmation:</label>
            <input type="password" class="form-control" id="password_confirmation"
                   name="password_confirmation" ng-model="registerData.password_confirmation">
        </div>
	  
		<div class="form-group">
            <label for="Address">Address:</label>
            <input type="text" class="form-control" name="address" ng-model="registerData.address" id="address" >
        </div>
		<div class="form-group">
		<select name="country"  id="countryId" class="countries form-control" ng-model="registerData.country">
         <option value="">Select Country</option>
        </select>
		</div>
		<div class="form-group">
        <select name="state"  id="stateId" class="states form-control" ng-model="registerData.state">
          <option value="">Select State</option>
        </select>
		</div>
		<div class="form-group">
        <select name="city"  id="cityId" class="cities form-control" ng-model="registerData.city">
          <option value="">Select City</option>
        </select>
		</div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
        <script src="//geodata.solutions/includes/countrystatecity.js"></script>
      <div class="form-group" align="center">
       <input type="submit" name="register" class="btn btn-primary" value="Register" />
       <br />
       <input type="button" name="login_link" class="btn btn-primary btn-link" ng-click="showLogin()" value="Login" />
      </div>
	   <?php echo $__env->make('partials.formerrors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     </form>
    </div>
   </div>
   <!----
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Welcome to system</h3>
    </div>
    <div class="panel-body">
     <h1>Welcome - <?php //echo $_SESSION["name"];?></h1>
     <a href="logout.php">Logout</a>
    </div>
   </div>
   ---->

  </div>

 </body>
</html>
<script>
var app = angular.module('login_register_app', []);
app.controller('login_register_controller', function($scope, $http){
 $scope.closeMsg = function(){
  $scope.alertMsg = false;
 };

 $scope.login_form = true;

 $scope.showRegister = function(){
  $scope.login_form = false;
  $scope.register_form = true;
  $scope.alertMsg = false;
 };

 $scope.showLogin = function(){
  $scope.register_form = false;
  $scope.login_form = true;
  $scope.alertMsg = false;
 };

 $scope.submitRegister = function(){
  $http({
   method:"POST",
   url:"register",
   data:$scope.registerData
  }).success(function(data){
   $scope.alertMsg = true;
   //alert(data.error);
   console.log(data.error);
   if(data.error != '')
   {
    $scope.alertClass = 'alert-danger';
    $scope.alertMessage = data.error;
   }
   else
   {
    $scope.alertClass = 'alert-success';
    $scope.alertMessage = data.message;
    $scope.registerData = {};
   }
  });
 };

 $scope.submitLogin = function(){
  $http({
   method:"POST",
   url:"login",
   data:$scope.loginData
  }).success(function(data){
	  $scope.alertMsg = true;
	  
   if(data.error != '')
   {
    $scope.alertMsg = true;
    $scope.alertClass = 'alert-danger';
    $scope.alertMessage = data.error;
   }else
   {
	   alert(data);
    window.location= "http://localhost/mylaravel/dashboard";
   }
  });
 };

});
</script>
<?php /**PATH D:\xampp\htdocs\mylaravel\resources\views/welcome.blade.php ENDPATH**/ ?>