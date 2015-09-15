<!DOCTYPE html>
<html>
<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd)	{
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
<script src= "assets/ajax.googleapis.com_ajax_libs_angularjs_1.3.14_angular.min.js"></script>
<body>

<div ng-app="myApp" ng-controller="customersCtrl"> 

    <table class="table table-hover">
    <tr>
        <thead>
        <th>STUDENT</th>
        <th style="text-align: center">PROGRAMME</th>
        <th>LEVEL</th>
        <th>PASSWORD</th>
        </thead>
    </tr>
  <tr ng-repeat="x in names">
    <td>{{x.Student}}</td>
    <td style="text-align: left">{{x.Prog}}</td>
     <td>{{x.Level}}</td>
     <td>{{x.Pass}}</td>
  </tr>
</table>

</div>

<script>
var app = angular.module('myApp', []);
app.controller('customersCtrl', function($scope, $http) {
   $http.get("bulk_password.php?id='100'")
   .success(function (response) {$scope.names = response.records;});
});
</script>

</body>
</html>
