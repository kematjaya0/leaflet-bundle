function styletrasnparan(feature) {
    return {
        weight: 2,
        opacity: 1,
        color: 'black',
        dashArray: '3',
        fillOpacity: 0
    };
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

var baseLayers={
    'Empty': L.tileLayer(''),
    // "Esri World Dark":L.tileLayer('https://server.arcgisonline.com/arcgis/rest/services/Canvas/World_Dark_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
    //     attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>',
    //     maxZoom: 16
    // }),
    "OSM":L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }),
    // "Esri World Gray":L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Canvas/World_Light_Gray_Base/MapServer/tile/{z}/{y}/{x}', {
    //     attribution: 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>',
    //     maxZoom: 16
    // }),
    "Google Street":L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution:'Map data &copy; Google | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>'
    }),
    "Google Hybrid":L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution:'Map data &copy; Google | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>'
    }),
    "Google Satelite":L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution:'Map data &copy; Google | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>'
    }),
    "Google Traffic":L.tileLayer('https://{s}.google.com/vt/lyrs=m@221097413,traffic&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        min5oom: 2,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution:'Map data &copy; Google | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>'
    }),
    "Google Terrain":L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution:'Map data &copy; Google | Map By <a href="https://idraxy.web.app" target="_blank">Draxgist & Team</a>'
    }),
}

var mapOptions = {
    attributionControl: false,
    center: [-6.9106698,112.4619926], zoom: 7,
    zoomControl: false,
    bounceAtZoomLimits:false,
    // minZoom: 8,
    // maxZoom: 14,
    maxBounds:[
        [-9.319,110.868],
        [-5.713,116.103]
    ],
    layers: [
        baseLayers["Google Traffic"]
    ]
}

// Creating a map object
var map = new L.map('map', mapOptions);

var myStyle = {
    "color": "green",
    "weight": 2,
    "opacity": 1
};

L.Control.zoomHome = L.Control.extend({
    options: {
        position: 'topright',
        zoomInText: '+',
        zoomInTitle: 'Zoom in',
        zoomOutText: '-',
        zoomOutTitle: 'Zoom out',
        zoomHomeText: '<i class="fa fa-home"></i>',
        zoomHomeTitle: 'Zoom home'
    },

    onAdd: function (map) {
        var controlName = 'gin-control-zoom',
            container = L.DomUtil.create('div', controlName + ' leaflet-bar'),
            options = this.options;

        this._zoomInButton = this._createButton(options.zoomInText, options.zoomInTitle,
            controlName + '-in', container, this._zoomIn);
        this._zoomHomeButton = this._createButton(options.zoomHomeText, options.zoomHomeTitle,
            controlName + '-home', container, this._zoomHome);
        this._zoomOutButton = this._createButton(options.zoomOutText, options.zoomOutTitle,
            controlName + '-out', container, this._zoomOut);

        this._updateDisabled();
        map.on('zoomend zoomlevelschange', this._updateDisabled, this);

        return container;
    },

    onRemove: function (map) {
        map.off('zoomend zoomlevelschange', this._updateDisabled, this);
    },

    _zoomIn: function (e) {
        this._map.zoomIn(e.shiftKey ? 3 : 1);
    },

    _zoomOut: function (e) {
        this._map.zoomOut(e.shiftKey ? 3 : 1);
    },

    _zoomHome: function (e) {
        map.setView([-6.9106698,112.4619926], 7);
    },

    _createButton: function (html, title, className, container, fn) {
        var link = L.DomUtil.create('a', className, container);
        link.innerHTML = html;
        link.href = '#';
        link.title = title;

        L.DomEvent.on(link, 'mousedown dblclick', L.DomEvent.stopPropagation)
            .on(link, 'click', L.DomEvent.stop)
            .on(link, 'click', fn, this)
            .on(link, 'click', this._refocusOnMap, this);

        return link;
    },

    _updateDisabled: function () {
        var map = this._map,
            className = 'leaflet-disabled';

        L.DomUtil.removeClass(this._zoomInButton, className);
        L.DomUtil.removeClass(this._zoomOutButton, className);

        if (map._zoom === map.getMinZoom()) {
            L.DomUtil.addClass(this._zoomOutButton, className);
        }
        if (map._zoom === map.getMaxZoom()) {
            L.DomUtil.addClass(this._zoomInButton, className);
        }
    }

});
// add the new control to the map
var zoomHome = new L.Control.zoomHome({position: 'topleft'});
zoomHome.addTo(map);
// create fullscreen control
var fsControl = new L.Control.FullScreen();
// add fullscreen control to the map
map.addControl(fsControl);

// detect fullscreen toggling
map.on('enterFullscreen', function () {
    if (window.console) window.console.log('enterFullscreen');
});
map.on('exitFullscreen', function () {
    if (window.console) window.console.log('exitFullscreen');
});

L.browserPrint().addTo(map);
L.control.locate().addTo(map);

function onEachFeature(feature, layer) {
    // layer.setIcon(defaultMarker);
    var html = "<table class='table'>";
    for (prop in feature.properties) {
        html += "<tr><td>" + prop.replace('_', ' ') + "</td><td>&nbsp;:&nbsp;</td><td>" + feature.properties[prop] + "</td></tr>";
    };
    html += "</table>";
    layer.bindPopup(html);
}

function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

function onLocationFound(e) {
    var radius = e.accuracy;
    lokasimu.clearLayers();
    L.marker(e.latlng).addTo(lokasimu).bindPopup("Radius 1km dari lokasi anda.").openPopup();
    L.circle(e.latlng, 1000).addTo(lokasimu);
}

var lokasimu=L.featureGroup();
map.on('locationfound', onLocationFound);
map.addLayer(lokasimu);
L.Path.mergeOptions({
    fillColor:'#4bc0c0',
    weight: 2,
    opacity: 1,
    color: "#fff",
    // dashArray: '',
    fillOpacity: 0.5
})

var miniMap = new L.Control.MiniMap(baseLayers["Google Street"], {
    toggleDisplay: true,
    autoToggleDisplay: true,
    width: 100,
    height: 100
}).addTo(map);
L.control.scale({position: 'bottomright'}).addTo(map);