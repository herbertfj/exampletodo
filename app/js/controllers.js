(function () {
  'use strict';

  var app = angular.module('exampletodo.controllers', [
    'exampletodo.services'
  ]);
  
  app.controller('TodoCtrl', ["$scope", "Data", function($scope, Data) {
    $scope.todos = [];
    $scope.editTodo = {};

    var getTodos = function() {
      Data.getTodos().then(function (promise) {
        $scope.todos = promise.data;
        console.log('<<< Retrieved todos.');
      }, function(error) {
        console.log('Promise failure: ' + error);
      });
    };

    getTodos();

    $scope.addTodo = function () {
      if ($scope.newTodo == '')
        return;

      var message = $scope.newTodo;
      $scope.newTodo = '';

      Data.addTodo(message).then(function (promise) {
        getTodos();
      });
    };

    $scope.deleteTodo = function (todo, i) {
      Data.deleteTodo(todo.nid).then(function (promise) {
        $scope.todos.splice(i, 1)
      });
    };

    $scope.updateTodo = function (todo) {
      Data.updateTodo(todo.nid, todo.message);
    };

    $scope.beginEdit = function(todo) {
      $scope.editTodo = angular.copy(todo);
    };

    $scope.cancel = function(e, i) {
      if (e.keyCode == 27)
        $scope.todos[i] = angular.copy($scope.editTodo);
      if (e.keyCode == 13)
        e.target.blur();
    };

  }]);

})();
