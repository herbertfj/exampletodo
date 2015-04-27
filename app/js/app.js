(function () {
  'use strict';

  var app = angular.module('exampletodo', [
    'ngRoute',
    'exampletodo.controllers'
  ]);

  app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/views/main.html',
        controller: 'TodoCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });

    $locationProvider.html5Mode(true);
  });

})();
