$(function(){
  var markerBlueBig = { fill:'rgba(255,255,255,0.4)', stroke:'#27AAE1' };
  var markerBlueSmall = { fill:'rgba(255,255,255,0.4)', stroke:'#27AAE1' };
  var markerRedBig = { fill:'rgba(255,255,255,0.4)', stroke:'#f35958' };
  var markerRedSmall = { fill:'rgba(255,255,255,0.4)', stroke:'#f35958' };
  var markerYellowBig = { fill:'rgba(255,255,255,0.4)', stroke:'#e09c4b' };
  var markerYellowSmall = { fill:'rgba(255,255,255,0.4)', stroke:'#e09c4b' };
  var map,
      markers = [
        {latLng: [33.97832411, -84.4783064], name: '887.70', style: markerBlueBig },
        {latLng: [30.51220349999999, -97.67312530000001], name: '755.16', style: markerBlueSmall },
        {latLng: [39.4014955, -76.6019125], name: '310.69', style: markerRedSmall },
        {latLng: [33.37857109999999, -86.80439], name: '405.17', style: markerRedBig },
        {latLng: [43.1938516, -71.5723953], name: '248.31', style: markerYellowBig },
        {latLng: [43.0026291, -78.8223134], name: '207.35', style: markerYellowSmall },
        {latLng: [33.836081, -81.1637245], name: '217.22', style: markerRedBig },
        {latLng: [41.7435073, -88.0118473], name: '280.71', style: markerBlueSmall },
        {latLng: [39.1031182, -84.5120196], name: '210.32', style: markerBlueBig },
        {latLng: [41.6661573, -81.339552], name: '1025.42', style: markerYellowSmall },
        {latLng: [43.16103, -77.6109219], name: '310.69', style: markerBlueSmall },
        {latLng: [38.6105426, -90.3371889], name: '405.17', style: markerYellowBig },        
        {latLng: [29.4241219, -98.49362819999999], name: '248.31', style: markerRedBig },        
        {latLng: [27.9249117, -82.5943072], name: '207.35', style: markerRedBig },
        {latLng: [36.9211118, -76.32017549999999], name: '217.22', style: markerYellowBig },
        {latLng: [38.9897306, -77.41000939999999], name: '280.71', style: markerBlueBig }
      ],
      cityAreaData = [
        887.70,
        755.16,
        310.69,
        405.17,
        248.31,
        207.35,
        217.22,
        280.71,
        210.32,
        1025.42,
        310.69,
        405.17,
        248.31,
        207.35,
        217.22,
        280.71
      ]

  map = new jvm.WorldMap({
    container: $('#us-map'),
    map: 'us_aea_en',
    backgroundColor:"#fff",
    regionsSelectable: true,
    markersSelectable: true,
    markers: markers,
    focusOn:{
      x: 0.5,
      y: 0.5,
      scale: 1.2
    },
    markerStyle: {
      initial: {
        fill: '#4DAC26'
      },
       hover: {
        fill: 'rgba(255,255,255,0.7)',
        stroke: '#999',
        "stroke-width": 1
      },
      selected: {
        fill: 'rgba(255,255,255,0.5)',
        "stroke-width": 5
      }
    },
    regionStyle: {
      initial: {
        fill: '#dfdfdf'
      },
      selected: {
        fill: '#b1e5e5'
      }
    },
    series: {
      markers: [{
        attribute: 'r',
        scale: [5, 25],
        values: cityAreaData
      }]
    },
    onMarkerLabelShow: function(event, label, code) {
     label.html('<span class="map-tooltip">'+ label.html() + '</span>');                
    },
    onRegionLabelShow: function(event, label, code) {
     label.html('<span class="map-tooltip map-tooltip--region">'+ label.html() + '</span>');                
    },
    onRegionSelected: function(){
      if (window.localStorage) {
        window.localStorage.setItem(
          'jvectormap-selected-regions',
          JSON.stringify(map.getSelectedRegions())
        );
      }
    },
    onMarkerSelected: function(){
      if (window.localStorage) {
        window.localStorage.setItem(
          'jvectormap-selected-markers',
          JSON.stringify(map.getSelectedMarkers())
        );
      }
    }
  });
  map.setSelectedRegions( JSON.parse( window.localStorage.getItem('jvectormap-selected-regions') || '[]' ) );
  map.setSelectedMarkers( JSON.parse( window.localStorage.getItem('jvectormap-selected-markers') || '[]' ) );
});