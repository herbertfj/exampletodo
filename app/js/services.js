(function () {
  'use strict';

  var app = angular.module('exampletodo.services', []);

  app.factory('Data', ["$http", function($http) {
    var response = {};

    response.getTodos = function () {
      return $http.get('api/todo');
    };

    response.addTodo = function (message) {
      return $http.post('api/todo', { message: message })
        .success(function () {
          console.log('>>> Added todo: ' + message);
        });
    };

    response.deleteTodo = function (id) {
      return $http.delete('api/todo/' + id)
        .success(function () {
          console.log('>>> Deleted todo: ' + id);
        });
    };

    response.updateTodo = function (id, message) {
      $http.put('api/todo/' + id, { message: message })
        .success(function () {
          console.log('>>> Updated todo: ' + id);
        });
    };

    return response;
  }]);

})();
