$(document).ready(function() {
  "use strict";

	/*----------------------------------------------
	 ----------- Map Function  --------------------
	 -------------------------------------------------*/
	var mapWrap = $('#map');
	if (mapWrap.length) {
		google.maps.event.addDomListener(window, 'load', initialize);

	}
 })
/*-----------------------------------------------
 -----------  Map Color Theme Function  ----------
 -------------------------------------------------*/
var mapWrap = $('#map');
if (mapWrap.length) {
	var myCenter = new google.maps.LatLng(51.538308, -0.3817765);
	function initialize() {
		var mapProp = {
			center : myCenter,
			zoom : 15,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			scrollwheel : false,
			styles : [{
				elementType : 'geometry',
				stylers : [{
					color : '#242f3e'
				}]
			}, {
				elementType : 'labels.text.stroke',
				stylers : [{
					color : '#242f3e'
				}]
			}, {
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#746855'
				}]
			}, {
				featureType : 'administrative.locality',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#d59563'
				}]
			}, {
				featureType : 'poi',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#d59563'
				}]
			}, {
				featureType : 'poi.park',
				elementType : 'geometry',
				stylers : [{
					color : '#263c3f'
				}]
			}, {
				featureType : 'poi.park',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#6b9a76'
				}]
			}, {
				featureType : 'road',
				elementType : 'geometry',
				stylers : [{
					color : '#38414e'
				}]
			}, {
				featureType : 'road',
				elementType : 'geometry.stroke',
				stylers : [{
					color : '#212a37'
				}]
			}, {
				featureType : 'road',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#9ca5b3'
				}]
			}, {
				featureType : 'road.highway',
				elementType : 'geometry',
				stylers : [{
					color : '#746855'
				}]
			}, {
				featureType : 'road.highway',
				elementType : 'geometry.stroke',
				stylers : [{
					color : '#1f2835'
				}]
			}, {
				featureType : 'road.highway',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#f3d19c'
				}]
			}, {
				featureType : 'transit',
				elementType : 'geometry',
				stylers : [{
					color : '#2f3948'
				}]
			}, {
				featureType : 'transit.station',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#d59563'
				}]
			}, {
				featureType : 'water',
				elementType : 'geometry',
				stylers : [{
					color : '#17263c'
				}]
			}, {
				featureType : 'water',
				elementType : 'labels.text.fill',
				stylers : [{
					color : '#515c6d'
				}]
			}, {
				featureType : 'water',
				elementType : 'labels.text.stroke',
				stylers : [{
					color : '#17263c'
				}]
			}]
		};
		var map = new google.maps.Map(document.getElementById("map"), mapProp);

		var marker = new google.maps.Marker({
			position : myCenter,
			icon : {
				url : 'assets/images/map-pin.png',
				size : new google.maps.Size(90, 111), //marker image size
				origin : new google.maps.Point(0, 0), // marker origin
				anchor : new google.maps.Point(35, 86) // X-axis value (35, half of marker width) and 86 is Y-axis value (height of the marker).
			}
		});

		marker.setMap(map);

	}

	function reloadStylesheets() {
		var queryString = 'reload=' + new Date().getTime();
		$('link[rel="stylesheet"]').each(function() {
			if (this.href.indexOf('?') === -1) {
				this.href = this.href + '&' + queryString;
			} else {
				this.href = this.href + '?' + queryString;
			}
		});
	}

}
