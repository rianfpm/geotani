$(document).ready(function ($) {
  "use strict";

  var mapId = "gtn-map-hero";

  //==================================================================================================================
  // VARIABLES
  // =================================================================================================================

  var newMarkers = [];
  var loadedMarkersData = [];
  var allMarkersData;
  var lastMarker;
  var map;
  var markerCluster;

  if ($("#" + mapId).length) {
    //==============================================================================================================
    // MAP SETTINGS
    // =============================================================================================================
    var mapElement = $(document.getElementById(mapId));
    var mapDefaultZoom = parseInt(mapElement.attr("data-gtn-map-zoom"), 10);
    var centerLatitude = mapElement.attr("data-gtn-map-center-latitude");
    var centerLongitude = mapElement.attr("data-gtn-map-center-longitude");
    var locale = mapElement.attr("data-gtn-locale");
    var currency = mapElement.attr("data-gtn-currency");
    var unit = mapElement.attr("data-gtn-unit");
    var controls = parseInt(mapElement.attr("data-gtn-map-controls"), 10);
    var scrollWheel = parseInt(mapElement.attr("data-gtn-map-scroll-wheel"), 10);
    var leafletMapProvider = mapElement.attr("data-gtn-map-leaflet-provider");
    var leafletAttribution = mapElement.attr("data-gtn-map-leaflet-attribution");
    var zoomPosition = mapElement.attr("data-gtn-map-zoom-position");
    var mapBoxAccessToken = mapElement.attr("data-gtn-map-mapbox-access-token");
    var mapBoxId = mapElement.attr("data-gtn-map-mapbox-id");

    

    if (mapElement.attr("data-gtn-display-additional-info")) {
      var displayAdditionalInfoTemp = mapElement
        .attr("data-gtn-display-additional-info")
        .split(";");
      var displayAdditionalInfo = [];
      for (var i = 0; i < displayAdditionalInfoTemp.length; i++) {
        displayAdditionalInfo.push(displayAdditionalInfoTemp[i].split("_"));
      }
    }

    // Default map zoom
    if (!mapDefaultZoom) {
      mapDefaultZoom = 14;
    }

    //==================================================================================================================
    // MAP ELEMENT
    // =================================================================================================================
    map = L.map(mapId, {
      zoomControl: false,
      scrollWheelZoom: scrollWheel,
    });
    map.setView([centerLatitude, centerLongitude], mapDefaultZoom);

    L.tileLayer(leafletMapProvider, {
      attribution: leafletAttribution,
      id: mapBoxId,
      accessToken: mapBoxAccessToken,
    }).addTo(map);

    if (controls !== 0 && zoomPosition) {
      L.control.zoom({ position: zoomPosition }).addTo(map);
    } else if (controls !== 0) {
      L.control.zoom({ position: "topright" }).addTo(map);
    }

    //==================================================================================================================
    // LOAD DATA
    // =================================================================================================================

    loadData();
  }

  function searchmap() {
    let latitude  = $("#latitude ").val();
    let longitude = $("#longitude").val();

    centerLatitude = latitude;
    centerLongitude = longitude;

    console.log(centerLatitude, centerLongitude);
    
    var platform = new H.service.Platform({
      'app_id': hereMapAppId,
      'app_code': hereMapAppCode
  });

  // Obtain the default map types from the platform object:
  var defaultLayers = platform.createDefaultLayers();

  // Instantiate (and display) a map object:
  map = new H.Map(
      document.getElementById(mapId),
      defaultLayers.normal.map,
      {
          zoom: mapDefaultZoom,
          center: {lat: centerLatitude, lng: centerLongitude}
      });

  // Set map behavior to interactive
  var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

  if (controls !== 0 && zoomPosition ) {
      var ui = H.ui.UI.createDefault(map, defaultLayers);
      var zoom = ui.getControl('zoom');
      zoom.setAlignment(zoomPosition);
  }
  else if( controls !== 0 ){
      ui = H.ui.UI.createDefault(map, defaultLayers);
  }
  if (scrollWheel === 0) {
      behavior.disable(2);
  }

  // Set map style
  setBaseLayer(map, platform);

  //==================================================================================================================
  // LOAD DATA
  // =================================================================================================================

  loadData();
  }

  function loadData(parameters) {
    $.ajax({
      url: "assets/db/items.json",
      dataType: "json",
      method: "GET",
      cache: false,
      success: function (results) {
        if (typeof parameters !== "undefined" && parameters["formData"]) {
          //loadFormData(parameters);
        } else {
          allMarkersData = results;
          loadedMarkersData = allMarkersData;
        }

        createMarkers(); // call function to create markers
      },
      error: function (e) {
        console.log(e);
      },
    });
  }

  //==================================================================================================================
  // Create DIV with the markers data
  // =================================================================================================================
  function createMarkers() {
    markerCluster = L.markerClusterGroup({
      showCoverageOnHover: false,
    });

    for (var i = 0; i < loadedMarkersData.length; i++) {
      var markerContent = document.createElement("div");

      markerContent.innerHTML =
        '<div class="gtn-marker-wrapper">' +
        '<a href="#gtn-map-hero" class="gtn-marker" data-gtn-id="' +
        loadedMarkersData[i]["id"] +
        '" data-gtn-ln="' +
        i +
        '">' +
        (loadedMarkersData[i]["ribbon"] !== undefined
          ? '<div class="gtn-marker__feature">' +
            loadedMarkersData[i]["ribbon"] +
            "</div>"
          : "") +
        (loadedMarkersData[i]["title"] !== undefined
          ? '<div class="gtn-marker__title">' +
            loadedMarkersData[i]["title"] +
            "</div>"
          : "") +
        (loadedMarkersData[i]["marker_image"] !== undefined
          ? '<div class="gtn-marker__image gtn-black-gradient" style="background-image: url(' +
            loadedMarkersData[i]["marker_image"] +
            ')"></div>'
          : '<div class="gtn-marker__image gtn-black-gradient" style="background-image: url(assets/img/marker-default-img.png)"></div>') +
        "</a>" +
        "</div>";

      placeLeafletMarker({
        i: i,
        markerContent: markerContent,
        method: "latitudeLongitude",
      });
    }

    // After the markers are created, do the rest

    markersDone();
  }

  //==================================================================================================================
  // When markers are placed, do the rest
  // =================================================================================================================
  function markersDone() {
    //==================================================================================================================
    // MARKER CLUSTERER
    // =============================================================================================================
    map.addLayer(markerCluster);
    map.on("moveend", createSideBarResult);
    createSideBarResult();
  }

  //==================================================================================================================
  // Google Rich Marker plugin
  // =================================================================================================================

  function placeLeafletMarker(parameters) {
    var i = parameters["i"];

    // Define marker HTML

    var markerIcon = L.divIcon({
      html: parameters["markerContent"].innerHTML,
      iconSize: [42, 47],
      iconAnchor: [0, 47],
    });

    // Attach marker to map
    var marker = L.marker(
      [loadedMarkersData[i]["latitude"], loadedMarkersData[i]["longitude"]],
      {
        icon: markerIcon,
      }
    );

    marker.loopNumber = i;

    markerCluster.addLayer(marker);

    // Open Popup on click

    marker.on("click", function () {
      if (lastMarker && lastMarker._icon) {
        $(lastMarker._icon.firstChild).removeClass("gtn-hide-marker");
      }
      openInfobox({
        id: $(this._icon).find(".gtn-marker").attr("data-gtn-id"),
        parentMarker: marker,
        i: i,
        url: "assets/db/items.json",
      });
    });

    newMarkers.push(marker);
  }

  //==================================================================================================================
  // Open InfoBox on marker click
  // =================================================================================================================
  function openInfobox(parameters) {
    var i = parameters["i"];
    var parentMarker = parameters["parentMarker"];
    var id = parameters["id"];
    var infoboxHtml = document.createElement("div");

    // First create and HTML for infobox
    createInfoBoxHTML({ i: i, infoboxHtml: infoboxHtml });

    //==============================================================================================================
    // Set InfoBox options
    //==============================================================================================================

    var popup = L.popup({
      closeButton: false,
      offset: [120, 0],
      closeOnClick: false,
    })
      .setLatLng([parentMarker._latlng.lat, parentMarker._latlng.lng])
      .setContent(infoboxHtml)
      .openOn(map);

    // Set the new "Last" opened marker
    lastMarker = parentMarker;

    // Hide the current marker, so only InfoBox is visible
    parentMarker._markerIcon = parentMarker._icon.firstChild;
    $(parentMarker._icon.firstChild).addClass("gtn-hide-marker");

    setTimeout(function () {
      $(".gtn-infobox[data-gtn-id='" + id + "']")
        .closest(".infobox-wrapper")
        .addClass("gtn-show");

      $(".gtn-infobox[data-gtn-id='" + id + "'] .gtn-close").on(
        "click",
        function () {
          $(".gtn-infobox[data-gtn-id='" + id + "']")
            .closest(".infobox-wrapper")
            .removeClass("gtn-show");
          $(parentMarker._markerIcon).removeClass("gtn-hide-marker");
          map.closePopup();
        }
      );
    }, 50);
  }

  //==================================================================================================================
  // Create Infobox HTML element
  //==================================================================================================================

  function createInfoBoxHTML(parameters) {
    var i = parameters["i"];
    var infoboxHtml = parameters["infoboxHtml"];

    infoboxHtml.innerHTML =
      '<div class="infobox-wrapper">' +
      '<div class="gtn-infobox" data-gtn-id="' +
      loadedMarkersData[i]["id"] +
      '">' +
      '<img src="assets/img/infobox-close.svg" class="gtn-close">' +
      (loadedMarkersData[i]["ribbon_corner"] !== undefined
        ? '<div class="gtn-ribbon-corner"><span>' +
          loadedMarkersData[i]["ribbon_corner"] +
          "</span></div>"
        : "") +
      '<a href="' +
      loadedMarkersData[i]["url"] +
      '" class="gtn-infobox__wrapper gtn-black-gradient">' +
      (loadedMarkersData[i]["badge"] !== undefined &&
      loadedMarkersData[i]["badge"].length > 0
        ? '<div class="badge badge-dark">' +
          loadedMarkersData[i]["badge"] +
          "</div>"
        : "") +
      '<div class="gtn-infobox__content">' +
      '<figure class="gtn-item__info">' +
      (loadedMarkersData[i]["title"] !== undefined &&
      loadedMarkersData[i]["title"].length > 0
        ? "<h4>" + loadedMarkersData[i]["title"] + "</h4>"
        : "") +
      "</figure>" +
      additionalInfoHTML({ display: displayAdditionalInfo, i: i }) +
      "</div>" +
      '<div class="gtn-infobox_image" style="background-image: url(' +
      loadedMarkersData[i]["marker_image"] +
      ')"></div>' +
      "</a>" +
      "</div>" +
      "</div>";
  }

  //==================================================================================================================
  // Create Additional Info HTML element
  //==================================================================================================================

  function additionalInfoHTML(parameters) {
    var i = parameters["i"];
    var displayParameter;

    var additionalInfoHtml = "";
    for (var a = 0; a < parameters["display"].length; a++) {
      displayParameter = parameters["display"][a];
      if (loadedMarkersData[i][displayParameter[0]] !== undefined) {
        additionalInfoHtml +=
          "<dl>" +
          "<dt>" +
          displayParameter[1] +
          "</dt>" +
          "<dd>" +
          loadedMarkersData[i][displayParameter[0]] +
          (displayParameter[a] === "area" ? unit : "") +
          "</dd>" +
          "</dl>";
      }
    }
    if (additionalInfoHtml) {
      return (
        '<div class="gtn-description-lists">' + additionalInfoHtml + "</div>"
      );
    } else {
      return "";
    }
  }

  //==================================================================================================================
  // Create SideBar HTML Results
  //==================================================================================================================
  function createSideBarResult() {
    //var visibleMarkersId = [];
    var visibleMarkersOnMap = [];
    var resultsHtml = [];

    for (var i = 0; i < loadedMarkersData.length; i++) {
      //visibleMarkersOnMap.push( newMarkers[i] );

      if (map.getBounds().contains(newMarkers[i].getLatLng())) {
        visibleMarkersOnMap.push(newMarkers[i]);
        //newMarkers[i].addTo(map);
      } else {
        //newMarkers[i].setVisible(false);
        //newMarkers[i].remove();
      }
    }

    //markerCluster.refreshClusters();

    for (i = 0; i < visibleMarkersOnMap.length; i++) {
      var id = visibleMarkersOnMap[i].loopNumber;
      var additionalInfoHtml = "";

      if (loadedMarkersData[id]["additional_info"]) {
        for (
          var a = 0;
          a < loadedMarkersData[id]["additional_info"].length;
          a++
        ) {
          additionalInfoHtml +=
            "<dl>" +
            "<dt>" +
            loadedMarkersData[id]["additional_info"][a]["title"] +
            "</dt>" +
            "<dd>" +
            loadedMarkersData[id]["additional_info"][a]["value"] +
            "</dd>" +
            "</dl>";
        }
      }

      resultsHtml.push(
        '<div class="gtn-result-link" data-gtn-id="' +
          loadedMarkersData[id]["id"] +
          '" data-gtn-ln="' +
          newMarkers[id].loopNumber +
          '">' +
          '<span class="gtn-center-marker"><img src="assets/img/result-center.svg"></span>' +
          '<a href="' +
          loadedMarkersData[id]["url"] +
          '" class="card gtn-item gtn-card gtn-result">' +
          (loadedMarkersData[i]["ribbon_corner"] !== undefined
            ? '<div class="gtn-ribbon-corner"><span>' +
              loadedMarkersData[i]["ribbon_corner"] +
              "</span></div>"
            : "") +
          '<div href="#gtn-map-hero" class="card-img gtn-item__image" style="background-image: url(' +
          loadedMarkersData[id]["marker_image"] +
          ')"></div>' +
          '<div class="card-body">' +
          '<figure class="gtn-item__info">' +
          "<h4>" +
          loadedMarkersData[id]["title"] +
          "</h4>" +
          "<aside>" +
          '<i class="fa fa-map-marker mr-2"></i>' +
          loadedMarkersData[id]["address"] +
          "</aside>" +
          "</figure>" +
          additionalInfoHTML({ display: displayAdditionalInfo, i: i }) +
          "</div>" +
          '<div class="card-footer">' +
          '<span class="gtn-btn-arrow">Detail</span>' +
          "</div>" +
          "</a>" +
          "</div>"
      );
    }

    $(".gtn-resulgtn-wrapper").html(resultsHtml);

    var $results = $("#gtn-results").find(".gtn-sly-frame");
    if ($results.hasClass("gtn-loaded")) {
      $results.sly("reload");
    } else {
      initializeSly();
    }

    var resultsBar = $(
      ".scroll-wrapper.gtn-results__vertical-list, .scroll-wrapper.gtn-results__grid"
    );
    if ($(window).width() < 575) {
      resultsBar.find(".gtn-results__vertical").css("pointer-events", "none");
      resultsBar.on("click", function () {
        $(this).addClass("gtn-expanded");
        $(this).find(".gtn-results__vertical").css("pointer-events", "auto");
        $("#gtn-map-hero").addClass("gtn-dim-map");
      });

      $("#gtn-map-hero").on("click", function () {
        if (resultsBar.hasClass("gtn-expanded")) {
          resultsBar.removeClass("gtn-expanded");
          $("#gtn-map-hero").removeClass("gtn-dim-map");
          resultsBar
            .find(".gtn-results__vertical")
            .css("pointer-events", "none");
        }
      });
    } else {
      resultsBar.removeClass("gtn-expanded");
      resultsBar.find(".gtn-results__vertical").css("pointer-events", "auto");
      $("#gtn-map-hero").removeClass("gtn-dim-map");
    }
  }

  // Center map on result click (Disabled)
  //==============================================================================================================

  $(document).on("click", ".gtn-center-marker", function () {
    $(".gtn-marker").parent().removeClass("gtn-active-marker");
    map.setView(newMarkers[$(this).parent().attr("data-gtn-ln")].getLatLng());
    var id = $(this).parent().attr("data-gtn-id");
    $(".gtn-marker[data-gtn-id='" + id + "']")
      .parent()
      .addClass("gtn-active-marker");
  });

  // Highlight marker on result hover
  //==============================================================================================================

  var timer;
  $(document).on(
    {
      mouseenter: function () {
        var id = $(this).parent().attr("data-gtn-id");
        timer = setTimeout(function () {
          $(".gtn-marker").parent().addClass("gtn-marker-hide");
          $(".gtn-marker[data-gtn-id='" + id + "']")
            .parent()
            .addClass("gtn-active-marker");
        }, 500);
      },
      mouseleave: function () {
        clearTimeout(timer);
        $(".gtn-marker")
          .parent()
          .removeClass("gtn-active-marker")
          .removeClass("gtn-marker-hide");
      },
    },
    ".gtn-result"
  );

  function formatPrice(price) {
    return Number(price)
      .toLocaleString(locale, { style: "currency", currency: currency })
      .replace(/\D\d\d$/, "");
  }

  var simpleMapId = "gtn-map-simple";
  if ($("#" + simpleMapId).length) {
    mapElement = $(document.getElementById(simpleMapId));
    mapDefaultZoom = parseInt(mapElement.attr("data-gtn-map-zoom"), 10);
    centerLatitude = mapElement.attr("data-gtn-map-center-latitude");
    centerLongitude = mapElement.attr("data-gtn-map-center-longitude");
    controls = parseInt(mapElement.attr("data-gtn-map-controls"), 10);
    scrollWheel = parseInt(mapElement.attr("data-gtn-map-scroll-wheel"), 10);
    leafletMapProvider = mapElement.attr("data-gtn-map-leaflet-provider");
    var markerDrag = parseInt(mapElement.attr("data-gtn-map-marker-drag"), 10);

    if (!mapDefaultZoom) {
      mapDefaultZoom = 14;
    }

    map = L.map(simpleMapId, {
      zoomControl: false,
      scrollWheelZoom: scrollWheel,
    });
    map.setView([centerLatitude, centerLongitude], mapDefaultZoom);

    L.tileLayer(leafletMapProvider, {
      attribution: leafletAttribution,
      id: mapBoxId,
      accessToken: mapBoxAccessToken,
    }).addTo(map);

    controls === 1 ? L.control.zoom({ position: "topright" }).addTo(map) : "";

    var icon = L.icon({
      iconUrl: "assets/img/marker-small.png",
      iconSize: [22, 29],
      iconAnchor: [11, 29],
    });

    var marker = L.marker([centerLatitude, centerLongitude], {
      icon: icon,
      draggable: markerDrag,
    }).addTo(map);
  }
});
