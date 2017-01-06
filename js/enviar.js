
function insert(){
  //objt es el objeto con los datos a enviar, url la ruta para recibir los datos
 this.datasend= function (objt,url) {
   var d=new FormData();
   for(var i in objt){
     d.append(i,objt[i])
   }
    sed(d,url);
 };


  var client = new XMLHttpRequest();//
  if(window.XMLHttpRequest) {  //validar compatibilidad con los navegadores
    client = new XMLHttpRequest();
  }else if(window.ActiveXObject) {
    client = new ActiveXObject("Microsoft.XMLHTTP");
  }

   function sed(data,url) {//enviar datos
      client.open("POST", url, true);
      client.send(data);
   }

   client.onreadystatechange = function() {// verificar el status
      if (client.readyState == 4 && client.status == 200) {
        if(!client.responseText){
          window.location.href='http://localhost/smv/info.php';
        }else{
          //alert(client.responseText);
          window.location.href='http://localhost/smv';
        }
      }
   };
}
var enviar_php= new insert();


//enviar datos a php (code actualizado)
var res;
function _send(){
	this.h="hola";
	//enviar array
 this.datasend= function (objt,url) {
   var d=new FormData();
   for(var i in objt){
     d.append(i,objt[i]);
   }
    send(d,url);
 };
  //enviar formData
 this.dataformsend= function (objt,url) {
   var data = new FormData(objt); //Datos a enviar con el formulario
   send(data,url);

 };

  var client = new XMLHttpRequest();//
  if(window.XMLHttpRequest) {  //validar compatibilidad con los navegadores
    client = new XMLHttpRequest();
  }else if(window.ActiveXObject) {
    client = new ActiveXObject("Microsoft.XMLHTTP");
  }

   function send(data,url) {//enviar datos
      client.open("POST", url, true);
      client.send(data);


   }
      client.onreadystatechange = function () {// verificar el status
      if (client.readyState == 4 && client.status == 200) {
          this.responseText=(JSON.stringify(client.responseText));
          var res=(JSON.parse(this.responseText));
          if(res["mensa"]!=null){
          	alert(res["mensa"]);
          }
          if(res["data"]!=null){
          	if(res["id"]!=null){
          		document.getElementById(res["id"]).innerHTML=res["data"];

          	}else{
          		console.log("parametro de retorno no definido");
          	}
          }
          if(res["redi"]!=null){
          	window.location=res["redi"];
          }

      }

   };

}

function inserform(form,url) {
  var insertar=new _send();
  insertar.datasend(form,url);
}
function dataform(form,url) {
  var insertar=new _send();
  insertar.dataformsend(form,url);
}
