sl.services.service('service', function($http, $q){
  this.fetch = function(method, url, data) {
    var _promise = $q.defer();
    $http({
      method: method,
      url: url,
      data: data,
      headers: {
        'Content-Type': 'application/json'
      }
    }).then(function(response) {
      _promise.resolve(response.data);
    }, function(error) {
      _promise.reject(error);
    });

    return _promise.promise;
  };

  this.get = function(url) {
    var data = {};
    return this.fetch('GET', url, data);
  };

  this.post = function(url, data) {
    return this.fetch('POST', url, data);
  };
});
