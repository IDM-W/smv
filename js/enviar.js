
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
