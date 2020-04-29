"use strict";

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance"); }

function _iterableToArrayLimit(arr, i) { if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) { return; } var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function initMap() {
  // Styles a map in night mode.
  var sydney = {
    lat: -33.863276,
    lng: 151.107977
  };
  map = new google.maps.Map(document.getElementById('map'), {
    center: sydney,
    zoom: 13
  });
  infoWindow = new google.maps.InfoWindow();
  searchStores();
}

function setOnClickListener() {
  var storeElements = document.querySelectorAll(".store-container");
  storeElements.forEach(function (elem, index) {
    elem.addEventListener('click', function () {
      new google.maps.event.trigger(markers[index], 'click');
    });
  });
}

var map;
var markers = [];
var infoWindow;

window.onload = function () {//es6 syntax
};

function clearLocations() {
  infoWindow.close();

  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }

  markers.length = 0;
}

function searchStores() {
  var foundStores = [];
  var zipCode = document.getElementById('zip-code-input').value;

  if (zipCode) {
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = stores[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var store = _step.value;
        var postal = store['address']['postalCode'].substring(0, 5);

        if (zipCode == postal) {
          foundStores.push(store);
        }
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator["return"] != null) {
          _iterator["return"]();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }
  } else {
    foundStores = stores;
  }

  clearLocations();
  displayStores(foundStores);
  showStoresMarker(foundStores);
  setOnClickListener(foundStores);
}

function displayStores(stores) {
  var storesHtml = '';
  var _iteratorNormalCompletion2 = true;
  var _didIteratorError2 = false;
  var _iteratorError2 = undefined;

  try {
    for (var _iterator2 = stores.entries()[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
      var _step2$value = _slicedToArray(_step2.value, 2),
          index = _step2$value[0],
          store = _step2$value[1];

      var name = store['name'];
      var address = store['addressLines'];
      var phone = store['phoneNumber'];
      storesHtml += "    \n\n        <div class='store-container'>\n            <div class=\"store-container-background\">\n                <div class='store-info-container'>\n                    <div class='store-address'>\n                        <span class=\"name\">".concat(name, "</span>\n                        <span class=\"addr\">").concat(address[0], "</span>\n                    </div>\n                    <div class='store-phone-no'>").concat(phone, "</div>\n                </div>\n\n\n                <div class=\"store-number-container\">\n                    <div class=\"store-number\">").concat(index + 1, "</div>\n                </div>\n            </div>\n        </div>\n        \n        ");
      document.querySelector('.store-list ').innerHTML = storesHtml;
    } //these backticks are used to append html and javascript side by side

  } catch (err) {
    _didIteratorError2 = true;
    _iteratorError2 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
        _iterator2["return"]();
      }
    } finally {
      if (_didIteratorError2) {
        throw _iteratorError2;
      }
    }
  }
}

function showStoresMarker(stores) {
  var bounds = new google.maps.LatLngBounds();
  var _iteratorNormalCompletion3 = true;
  var _didIteratorError3 = false;
  var _iteratorError3 = undefined;

  try {
    for (var _iterator3 = stores.entries()[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
      var _step3$value = _slicedToArray(_step3.value, 2),
          index = _step3$value[0],
          store = _step3$value[1];

      var name = store['name'];
      var address = store['addressLines'][0];
      var openStatus = store['openStatusText'];
      var phoneNumber = store['phoneNumber'];
      var latlng = new google.maps.LatLng(store['coordinates']['latitude'], store['coordinates']['longitude']);
      bounds.extend(latlng);
      createMarker(latlng, name, address, openStatus, phoneNumber, index + 1);
    }
  } catch (err) {
    _didIteratorError3 = true;
    _iteratorError3 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion3 && _iterator3["return"] != null) {
        _iterator3["return"]();
      }
    } finally {
      if (_didIteratorError3) {
        throw _iteratorError3;
      }
    }
  }

  map.fitBounds(bounds);
}

function createMarker(latlng, name, address, openStatusText, phoneNumber, index) {
  var html = "\n        <div class=\"store-info-window\">\n            <div class=\"store-info-name\">\n                ".concat(name, "\n            </div>\n            <div class=\"store-info-status\">\n                ").concat(openStatusText, "\n            </div>\n            <div class=\"store-info-address\">\n                <div class=\"circle\">\n                    <i class=\"fas fa-location-arrow\"></i>\n                </div>\n                ").concat(address, "\n            </div>\n            <div class=\"store-info-phone\">\n                <div class=\"circle\">\n                    <i class=\"fas fa-phone\"></i>\n                </div>\n                ").concat(phoneNumber, "\n            </div>\n        </div>\n    ");
  var marker = new google.maps.Marker({
    map: map,
    position: latlng,
    label: String(index)
  });
  google.maps.event.addListener(marker, 'click', function () {
    //info window
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
  });
  markers.push(marker);
}