$(document).ready(function($) {
    "use strict";

    //==================================================================================================================
    // VARIABLES
    // =================================================================================================================
    var mapId = "gtn-map-hero";
    var newMarkers = [];
    var loadedMarkersData = [];
    var allMarkersData;
    var lastInfobox;
    var lastMarker;
    var map;
    var markerCluster;

    if( $("#"+mapId).length ) {

        var mapElement = $(document.getElementById(mapId));
        var mapDefaultZoom = parseInt(mapElement.attr("data-gtn-map-zoom"), 10);
        var centerLatitude = mapElement.attr("data-gtn-map-center-latitude");
        var centerLongitude = mapElement.attr("data-gtn-map-center-longitude");
        var zoomPosition = mapElement.attr("data-gtn-map-zoom-position");
        var controls = parseInt(mapElement.attr("data-gtn-map-controls"), 10);
        ( controls === 0 ) ? controls = true : controls = false;
        var locale = mapElement.attr("data-gtn-locale");
        var currency = mapElement.attr("data-gtn-currency");
        var unit = mapElement.attr("data-gtn-unit");
        var scrollWheel = mapElement.attr("data-gtn-map-scroll-wheel");
        var mapStyle = mapElement.attr("data-gtn-google-map-style");

        if (mapElement.attr("data-gtn-display-additional-info")) {
            var displayAdditionalInfoTemp = mapElement.attr("data-gtn-display-additional-info").split(";");
            var displayAdditionalInfo = [];
            for (var i = 0; i < displayAdditionalInfoTemp.length; i++) {
                displayAdditionalInfo.push(displayAdditionalInfoTemp[i].split("_"));
            }
        }

        // Default map zoom
        if (!mapDefaultZoom) {
            mapDefaultZoom = 14;
        }


        if( controls !== 0 && zoomPosition ){
            zoomPosition = eval(zoomPosition);
        }

        //==============================================================================================================
        // MAP ELEMENT
        // =============================================================================================================
        map = new google.maps.Map(document.getElementById("gtn-map-hero"), {
            zoom: mapDefaultZoom,
            scrollwheel: scrollWheel,
            center: new google.maps.LatLng(centerLatitude, centerLongitude),
            mapTypeId: "roadmap",
            disableDefaultUI: controls,
            zoomControlOptions: {
                position: eval(zoomPosition)
            },
            styles: eval(mapStyle)
        });


        //==============================================================================================================
        // LOAD DATA
        // =============================================================================================================
        loadData();

    }

    function loadData(parameters) {
        $.ajax({
            url: "assets/db/items.json",
            dataType: "json",
            method: "GET",
            cache: false,
            success: function(results){

                if( typeof parameters !== "undefined" && parameters["formData"] ){

                }
                else {
                    allMarkersData = results;
                    loadedMarkersData = allMarkersData;
                }

                createMarkers(); // call function to create markers
            },
            error : function (e) {
                console.log(e);
            }
        });
    }

    /*
    $("#search-btn").on("click", function (e) {
        e.preventDefault();
        var formData = $(this).closest("form").serializeArray();
        loadData({"formData": formData})
    });
    */

    //==================================================================================================================
    // Create DIV with the markers data
    // =================================================================================================================
    function createMarkers(){

        for (var i = 0; i < loadedMarkersData.length; i++) {

            var markerContent = document.createElement('div');

            markerContent.innerHTML =
            '<a href="#" class="gtn-marker" data-gtn-id="'+ loadedMarkersData[i]["id"] +'">' +
                ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="gtn-marker__feature">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["title"] !== undefined ) ? '<div class="gtn-marker__title">'+ loadedMarkersData[i]["title"] +'</div>' : "" ) +
                //( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="gtn-marker__info">'+ currency  + loadedMarkersData[i]["price"] +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="gtn-marker__info">'+ formatPrice(loadedMarkersData[i]["price"]) +'</div>' : "" ) +
                ( ( loadedMarkersData[i]["marker_image"] !== undefined ) ? '<div class="gtn-marker__image gtn-black-gradient" style="background-image: url('+ loadedMarkersData[i]["marker_image"] +')"></div>' : '<div class="gtn-marker__image gtn-black-gradient" style="background-image: url(assets/img/marker-default-img.png)"></div>' ) +
            '</a>';

            placeRichMarker({"i": i, "markerContent": markerContent, "method": "latitudeLongitude"});

        }

        // After the markers are created, do the rest

        markersDone();
    }

    //==================================================================================================================
    // When markers are placed, do the rest
    // =================================================================================================================
    function markersDone(){

        //==================================================================================================================
        // GOOGLE MAPS MARKER CLUSTERER
        // =============================================================================================================
        var clusterStyles = [
            {
                url: 'assets/img/cluster.png',
                height: 48,
                width: 48
            }
        ];
        markerCluster = new MarkerClusterer(map, newMarkers, { styles: clusterStyles, maxZoom: 13, ignoreHidden: true });

        google.maps.event.trigger(map, 'idle');

        google.maps.event.addListener(map, 'idle', function(){
            createSideBarResult();
        });

    }

    //==================================================================================================================
    // Google Rich Marker plugin
    // =================================================================================================================
    function placeRichMarker(parameters){

        var i = parameters["i"];

        marker = new RichMarker({
            position: new google.maps.LatLng( loadedMarkersData[i]["latitude"], loadedMarkersData[i]["longitude"] ),
            map: map,
            draggable: false,
            content: parameters["markerContent"],
            flat: true,
            id: loadedMarkersData[i]["id"]
        });

        marker.content.className = "gtn-marker-wrapper";
        marker.loopNumber = i;

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                if( lastMarker ){
                    $(lastMarker.content).removeClass("gtn-hide-marker");
                }

                openInfobox({"id": $(this.content.firstChild).attr("data-gtn-id"), "parentMarker": this, "i": i, "url": "assets/db/items.json" });

                /*
                if( markerTarget == "sidebar"){
                    openSidebarDetail( $(this.content.firstChild).attr("data-id") );
                }
                else if( markerTarget == "infobox" ){
                    openInfobox( $(this.content.firstChild).attr("data-id"), this, i );
                }
                else if( markerTarget == "modal" ){
                    openModal($(this.content.firstChild).attr("data-id"), "modal_item.php", false, isFullScreen);
                }
                */
            }
        })(marker, parameters["i"]));

        newMarkers.push(marker);

    }

    //==================================================================================================================
    // Open InfoBox on marker click
    // =================================================================================================================
    function openInfobox(parameters){

        var i = parameters["i"];
        var parentMarker = parameters["parentMarker"];
        var id = parameters["id"];
        var infoboxHtml = document.createElement('div');

        // First create and HTML for infobox
        createInfoBoxHTML({"i": i, "infoboxHtml": infoboxHtml});

        //==============================================================================================================
        // Set InfoBox options
        //==============================================================================================================
        var infoboxOptions = {
            content: infoboxHtml,
            disableAutoPan: false,
            pixelOffset: new google.maps.Size(-21, -13),
            zIndex: null,
            alignBottom: true,
            boxClass: "infobox-wrapper",
            enableEventPropagation: true,
            infoBoxClearance: new google.maps.Size(1, 1)
        };

        //==============================================================================================================
        // Before showing new InfoBox, close the last one
        //==============================================================================================================

        // Check if the last InfoBox exists and hide it
        if( lastInfobox !== undefined ){
            $(lastInfobox.content_).closest(".infobox-wrapper").removeClass("gtn-show");
        }

        // Wait for the hiding animation and remove InfoBox from the map
        setTimeout(function(){
            if( lastInfobox !== undefined ){
                lastInfobox.close();
            }
            // Set new "Last" opened InfoBox
            lastInfobox = newMarkers[i].infobox;
        }, 200);

        // Hide the current marker, so only InfoBox is visible
        $(parentMarker.content).addClass("gtn-hide-marker");

        // Set the new "Last" opened marker
        lastMarker = parentMarker;

        // Open new InfoBox
        newMarkers[i].infobox = new InfoBox(infoboxOptions);
        newMarkers[i].infobox.open(map, parentMarker);

        setTimeout(function(){
            $(".gtn-infobox[data-gtn-id='"+ id +"']").closest(".infobox-wrapper").addClass("gtn-show");

            $(".gtn-infobox[data-gtn-id='"+ id +"'] .gtn-close").on("click", function () {
                $(".gtn-infobox[data-gtn-id='"+ id +"']").closest(".infobox-wrapper").removeClass("gtn-show");
                $(parentMarker.content).removeClass("gtn-hide-marker");
                setTimeout(function(){
                    newMarkers[i].infobox.close();
                }, 200);
            });
        }, 50);
    }

    //==================================================================================================================
    // Create Infobox HTML element
    //==================================================================================================================

    function createInfoBoxHTML(parameters){

        var i = parameters["i"];
        var infoboxHtml = parameters["infoboxHtml"];
        //var additionalInfoHtml = "";
        //var key = Object.keys(obj)[0];
        //console.log( Object.keys(loadedMarkersData[0]).length );
        //console.log( loadedMarkersData[0]["name"] );
        /*
        if( loadedMarkersData[i]["additional_info"] ){
            for( var a = 0; a < loadedMarkersData[i]["additional_info"].length; a++ ){
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + loadedMarkersData[i]["additional_info"][a]["title"] + '</dt>' +
                    '<dd>' + loadedMarkersData[i]["additional_info"][a]["value"] + '</dd>' +
                '</dl>';
            }
        }
        */
        infoboxHtml.innerHTML =
        '<div class="gtn-infobox" data-gtn-id="'+ loadedMarkersData[i]["id"] +'">' +
            '<img src="assets/img/infobox-close.svg" class="gtn-close">' +

            ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="gtn-ribbon">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
            ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="gtn-ribbon-corner"><span>'+ loadedMarkersData[i]["ribbon_corner"] +'</span></div>' : "" ) +

            '<a href="'+ loadedMarkersData[i]["url"] +'" class="gtn-infobox__wrapper gtn-black-gradient">' +
                ( ( loadedMarkersData[i]["badge"] !== undefined && loadedMarkersData[i]["badge"].length > 0 ) ? '<div class="badge badge-dark">'+ loadedMarkersData[i]["badge"] +'</div>' : "" ) +
                '<div class="gtn-infobox__content">' +
                    '<figure class="gtn-item__info">' +
                        ( ( loadedMarkersData[i]["price"] !== undefined && loadedMarkersData[i]["price"] > 0 ) ? '<div class="gtn-item__info-badge">'+ formatPrice(loadedMarkersData[i]["price"]) +'</div>' : "" ) +
                        ( ( loadedMarkersData[i]["title"] !== undefined && loadedMarkersData[i]["title"].length > 0 ) ? '<h4>'+ loadedMarkersData[i]["title"] +'</h4>' : "" ) +
                        ( ( loadedMarkersData[i]["address"] !== undefined && loadedMarkersData[i]["address"].length > 0 ) ? '<aside><i class="fa fa-map-marker mr-2"></i>'+ loadedMarkersData[i]["address"] +'</aside>' : "" ) +
                    '</figure>' +
                        additionalInfoHTML({display: displayAdditionalInfo, i: i}) +
                    //( ( loadedMarkersData[i]["additional_info"] !== undefined && loadedMarkersData[i]["additional_info"].length > 0 ) ? '<div class="gtn-description-lists">'+ additionalInfoHtml +'</div>' : "" ) +
                '</div>' +
                '<div class="gtn-infobox_image" style="background-image: url('+ loadedMarkersData[i]["marker_image"] +')"></div>' +
            '</a>' +
        '</div>';
    }

    //==================================================================================================================
    // Create Additional Info HTML element
    //==================================================================================================================

    function additionalInfoHTML(parameters){
        var i = parameters["i"];
        var displayParameter;


        /*
        var additionalInfoHtml = "";
        for( var a = 0; a < parameters["display"].length; a++ ){
            displayParameter = parameters["display"][a];
            if( loadedMarkersData[i][ displayParameter ] !== undefined ) {
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + loadedMarkersData[i][ displayParameter ]["title"] + '</dt>' +
                    '<dd>' + loadedMarkersData[i][ displayParameter ]["value"] + ((displayParameter === "area") ? unit : "") + '</dd>' +
                '</dl>';
            }
        }
        if( additionalInfoHtml ){
            return '<div class="gtn-description-lists">' + additionalInfoHtml +'</div>';
        }
        else {
            return "";
        }
        */
        //var temp = parameters["display"].split("_");

        var additionalInfoHtml = "";
        for( var a = 0; a < parameters["display"].length; a++ ){
            displayParameter = parameters["display"][a];
            if( loadedMarkersData[i][ displayParameter[0] ] !== undefined ) {
                additionalInfoHtml +=
                '<dl>' +
                    '<dt>' + displayParameter[1] + '</dt>' +
                    '<dd>' + loadedMarkersData[i][ displayParameter[0] ] + ((displayParameter[a] === "area") ? unit : "") + '</dd>' +
                '</dl>';
            }
        }
        if( additionalInfoHtml ){
            return '<div class="gtn-description-lists">' + additionalInfoHtml +'</div>';
        }
        else {
            return "";
        }
    }

    //==================================================================================================================
    // Create SideBar HTML Results
    //==================================================================================================================
    function createSideBarResult(){

        //var visibleMarkersId = [];
        var visibleMarkersOnMap = [];
        var resultsHtml = [];

        for( var i = 0; i < loadedMarkersData.length; i++ ){
            if ( map.getBounds().contains( newMarkers[i].getPosition()) ){
                visibleMarkersOnMap.push( newMarkers[i] );
                newMarkers[i].setVisible(true);
            }
            else {
                newMarkers[i].setVisible(false);
            }
        }

        markerCluster.repaint();

        for( i = 0; i < visibleMarkersOnMap.length; i++ ){
            var id = visibleMarkersOnMap[i].loopNumber;
            var additionalInfoHtml = "";

            if( loadedMarkersData[id]["additional_info"] ){
                for( var a = 0; a < loadedMarkersData[id]["additional_info"].length; a++ ){
                    additionalInfoHtml +=
                    '<dl>' +
                        '<dt>' + loadedMarkersData[id]["additional_info"][a]["title"] + '</dt>' +
                        '<dd>' + loadedMarkersData[id]["additional_info"][a]["value"] + '</dd>' +
                    '</dl>';
                }
            }

            resultsHtml.push(
                '<div class="gtn-result-link" data-gtn-id="' + loadedMarkersData[id]["id"] + '" data-gtn-ln="' + newMarkers[id].loopNumber + '">' +
                    '<span class="gtn-center-marker"><img src="assets/img/result-center.svg"></span>' +
                    '<a href="'+ loadedMarkersData[id]["url"] +'" class="card gtn-item gtn-card gtn-result">' +
                        ( ( loadedMarkersData[i]["ribbon"] !== undefined ) ? '<div class="gtn-ribbon">'+ loadedMarkersData[i]["ribbon"] +'</div>' : "" ) +
                        ( ( loadedMarkersData[i]["ribbon_corner"] !== undefined ) ? '<div class="gtn-ribbon-corner"><span>'+ loadedMarkersData[i]["ribbon_corner"] +'</span></div>' : "" ) +
                        '<div href="detail-01.html" class="card-img gtn-item__image" style="background-image: url('+ loadedMarkersData[id]["marker_image"] +')"></div>' +
                        '<div class="card-body">' +
                            '<div class="gtn-item__info-badge">'+ formatPrice(loadedMarkersData[id]["price"]) +'</div>' +
                            '<figure class="gtn-item__info">' +
                                '<h4>'+ loadedMarkersData[id]["title"] +'</h4>' +
                                '<aside>' +
                                    '<i class="fa fa-map-marker mr-2"></i>'+ loadedMarkersData[id]["address"] +'</aside>' +
                            '</figure>' +
                            additionalInfoHTML({display: displayAdditionalInfo, i: i}) +
                        '</div>' +
                        '<div class="card-footer">' +
                            '<span class="gtn-btn-arrow">Detail</span>' +
                        '</div>' +
                    '</a>' +
                '</div>'
            );
        }


        $(".gtn-resulgtn-wrapper").html(resultsHtml);

        if( $("#gtn-results .gtn-sly-frame").hasClass("gtn-loaded") ){
            $("#gtn-results .gtn-sly-frame").sly("reload");
        }
        else {
            initializeSly();
        }

        var resultsBar = $(".scroll-wrapper.gtn-results__vertical-list, .scroll-wrapper.gtn-results__grid");
        if ($(window).width() < 575) {
            resultsBar.find(".gtn-results__vertical").css("pointer-events", "none");
            resultsBar.on("click", function () {
                $(this).addClass("gtn-expanded");
                $(this).find(".gtn-results__vertical").css("pointer-events", "auto");
                $("#gtn-map-hero").addClass("gtn-dim-map");
            });

            $("#gtn-map-hero").on("click", function(){
                if (resultsBar.hasClass("gtn-expanded")) {
                    resultsBar.removeClass("gtn-expanded");
                    $("#gtn-map-hero").removeClass("gtn-dim-map");
                    resultsBar.find(".gtn-results__vertical").css("pointer-events", "none");
                }
            });
        }
        else {
            resultsBar.removeClass("gtn-expanded");
            resultsBar.find(".gtn-results__vertical").css("pointer-events", "auto");
            $("#gtn-map-hero").removeClass("gtn-dim-map");
        }

    }

    // Highlight marker on result hover
    //==============================================================================================================

    var timer;
    $(document).on({
        mouseenter: function () {
            var id = $(this).parent().attr("data-gtn-id");
            timer = setTimeout(function(){
                $(".gtn-marker").parent().addClass("gtn-marker-hide");
                $(".gtn-marker[data-gtn-id='" + id + "']").parent().addClass("gtn-active-marker");
            }, 500);
        },
        mouseleave: function () {
            clearTimeout(timer);
            $(".gtn-marker").parent().removeClass("gtn-active-marker").removeClass("gtn-marker-hide");
        }
    }, ".gtn-result");

    function formatPrice(price){
        return Number(price).toLocaleString(locale, { style: 'currency', currency: currency }).replace(/\D\d\d$/, '');
    }

    var simpleMapId = "gtn-map-simple";
    if( $("#"+simpleMapId).length ){

        mapElement = $(document.getElementById(simpleMapId));
        mapDefaultZoom = parseInt( mapElement.attr("data-gtn-map-zoom"), 10 );
        centerLatitude = mapElement.attr("data-gtn-map-center-latitude");
        centerLongitude = mapElement.attr("data-gtn-map-center-longitude");
        scrollWheel = parseInt( mapElement.attr("data-gtn-map-scroll-wheel"), 10 );
        var markerDrag = parseInt( mapElement.attr("data-gtn-map-marker-drag"), 10 );
        ( markerDrag === 1 ) ? markerDrag = true : markerDrag = false;
        controls =  parseInt( mapElement.attr("data-gtn-map-controls"), 10 );
        ( controls === 1 ) ? controls = false : controls = true ;
        mapStyle = mapElement.attr("data-gtn-google-map-style");

        if( !mapDefaultZoom ){
            mapDefaultZoom = 14;
        }

        var mapCenter = new google.maps.LatLng(centerLatitude,centerLongitude);
        var mapOptions = {
            zoom: mapDefaultZoom,
            center: mapCenter,
            disableDefaultUI: controls,
            scrollwheel: scrollWheel,
            styles: mapStyle
        };
        var element = document.getElementById(simpleMapId);
        map = new google.maps.Map(element, mapOptions);
        var marker = new google.maps.Marker({
            position: mapCenter,
            map: map,
            icon: "assets/img/marker-small.png",
            draggable: markerDrag
        });
    }

});


