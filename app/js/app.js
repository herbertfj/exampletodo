(function () {
  'use strict';

  var app = angular.module('exampletodo', [
    'ngRoute',
    'exampletodo.controllers'
  ]);

  app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });

    $locationProvider.html5Mode(true);
  });

})();
