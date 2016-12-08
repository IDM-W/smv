


var map;
var gdir;
var geocoder = null;
var addressMarker;



function initialize() {
if (GBrowserIsCompatible()) {
map = new GMap2(document.getElementById("mapa"));
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl());

gdir = new GDirections(map, document.getElementById("direcciones"));
GEvent.addListener(gdir, "load", onGDirectionsLoad);
GEvent.addListener(gdir, "error", handleErrors);

setDirections("barranquilla", "bogota", "es");

}
}

function setDirections(fromAddress, toAddress, locale) {
	
gdir.load("from: " + fromAddress + " to: " + toAddress,
{ "locale": "es" });
}

function handleErrors(){
if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
alert("Dirección no disponible.\nError code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_BAD_KEY)
alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);
else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
else alert("An unknown error occurred.");
}

function onGDirectionsLoad(){
}


var map = new GMap(document.getElementById("mapa")); map.addControl(new GLargeMapControl());

map.centerAndZoom(new GPoint(10.9642,-74.7970), 8);
map.addControl(new GMapTypeControl());
map.addControl(new GScaleControl());
map.addControl(new GOverviewMapControl());
map.setMapType(G_NORMAL_MAP);

function direction (ps) {

	if(ps.id=="sl"){
	 var origen=document.getElementById("lls").value;
	 var destino=document.getElementById("lll").value;
	 setDirections(origen,destino);		
	}else if(ps.id=="pb"){
	 var origen=document.getElementById("ls").value;
	 var destino=document.getElementById("ll").value;		 
	 setDirections(origen,destino);		
	}else if(ps.id=="ivp"){
	 var origen=document.getElementById("lds").value;
	 var destino=document.getElementById("ldl").value;		 
	 setDirections(origen,destino);		
	}

  
}

