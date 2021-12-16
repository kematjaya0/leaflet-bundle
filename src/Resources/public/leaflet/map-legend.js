var grades = grades1.filter( onlyUnique );
var labels = labels1.filter( onlyUnique );
var legend = L.control({position: 'bottomleft'});
legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    div.innerHTML += (`
            <div class="header-label-legend" style="background-color: #50c27c;padding: 1px;padding-left: 10px;padding-right: 10px;min-width: 100px;">
                <b><font size="3px">Legenda</font></b>
                <span class="btn btn-default btn-on-close" onclick="toggleLegend();"><i class="fa fa-times"></i> &nbsp;</span>
            </div>`);
    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
        div.innerHTML +=  (" <img src="+ labels[i] +" height='15' width='15'>&nbsp") + grades[i] +'</br>';
    }
    return div;
};
map.addControl(legend);

var showLegend = false;  // default value showing the legend
function toggleLegend() {
    if(showLegend === true){
        map.addControl(legend);
        showLegend = false;
    }else {
        map.removeControl(legend);
        showLegend = true;
    }
}