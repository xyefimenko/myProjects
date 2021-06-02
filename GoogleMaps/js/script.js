let panorama;

function initialize() {
    panorama = new google.maps.StreetViewPanorama(
        document.getElementById("street-view"),
        {
            position: { lat: 48.151957, lng: 17.073311   },
            pov: { heading: 165, pitch: 0 },
            zoom: 1,
        }
    );
}

function initMap() {
    const astorPlace = { lat: 48.151957, lng: 17.073311  };
    // Set up the map
    const map = new google.maps.Map(document.getElementById("map"), {
        center: astorPlace,
        zoom: 15,
        //streetViewControl: false,
    });
    initialize();
    // Set up the markers on the map
    const feiMarker = new google.maps.Marker({
        position: { lat: 48.151957, lng: 17.073311 },
        map,
        title: "FEI STU",
    });
    var info = new google.maps.InfoWindow({
        content: '<h3>Fakulta Elektotechniky a informatiky STU</h3><p><b>48.151957, 17.073311</b></p><p>Block A</p>'
    });

    var infoBus1 = new google.maps.InfoWindow({
        content: '<h3>Autobusova Zastavka "Zoo"</h3><p>(Neni daleko)</p>'
    });

    var infoBus2 = new google.maps.InfoWindow({
        content: '<h3>Autobusova Zastavka "Zoo"</h3><p>(Neni daleko)</p>'
    });

    var infoBus3 = new google.maps.InfoWindow({
        content: '<h3>Autobusova Zastavka "Botanicka zahrada"</h3><p>(Neni daleko)</p>'
    });

    const bus1Marker = new google.maps.Marker({
        position: { lat: 48.154893, lng: 17.074364 },
        map,
        title: "BUS stop",
        icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
    });

    const bus2Marker = new google.maps.Marker({
        position: { lat: 48.154139, lng: 17.075103 },
        map,
        title: "BUS stop",
        icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
    });

    const bus3Marker = new google.maps.Marker({
        position: { lat: 48.148420, lng: 17.071964 },
        map,
        title: "BUS stop",
        icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
    });

    bus1Marker.addListener("click", function (){
        infoBus1.open(map, bus1Marker)
    });

    bus2Marker.addListener("click", function (){
        infoBus2.open(map, bus2Marker)
    });

    bus3Marker.addListener("click", function (){
        infoBus3.open(map, bus3Marker)
    });

    feiMarker.addListener("click", function (){
        info.open(map, feiMarker)
    });
    //toggleStreetView()
    // We get the map's default panorama and set up some defaults.
    // Note that we don't yet set it visible.
    panorama.setPosition(astorPlace);
    panorama.setPov(
        /** @type {google.maps.StreetViewPov} */ {
            heading: 265,
            pitch: 0,
        }
    );
}

function toggleStreetView() {
    const toggle = panorama.getVisible();

    if (toggle == false) {
        panorama.setVisible(true);
    } else {
        panorama.setVisible(false);
    }
}

