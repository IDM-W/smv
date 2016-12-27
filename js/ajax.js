mostrarv();
function publicar() {
  $.ajax({
           type:'POST',
           url:"php/publicar.php",
           dataType:'HTML',
           data:{
            ls:$("#ls").val(),
            ll:$("#ll").val(),
            date:$("#date").val(),
            hora:$("#hora").val(),
            cupo:$("#cupo").val(),
            precio:$("#precio").val(),
            marca:$("#marca").val(),
            modelo:$("#modelo").val()
           },
           beforeSend: function(){

},
           success:function(datos){
              //alert(datos)
             if (datos==0) {
               alert("no se inserto");
             }else {


               $("#viaje_publico").css("display","block");
               document.getElementById('response').innerHTML=datos;
               $("#ls").val("");
               $("#ll").val("");
               $("#date").val("");
               $("#hora").val("");
               $("#cupo").val("");
               $("#precio").val("");
               $("#marca").val("");
               $("#modelo").val("");
             }

           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}

function mostrarv() {
  $.ajax({
           type:'POST',
           url:"php/mostrarv.php",
           dataType:'HTML',
           data:{

           },
           beforeSend: function(){

          },
           success:function(datos){
              $("#v_populares").html(datos);
           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}
function solicitar() {
  $.ajax({
           type:'POST',
           url:"php/soli.php",
           dataType:'HTML',
           data:{
            ls:$("#lls").val(),
            ll:$("#lll").val(),
            date:$("#ddate").val(),

           },
           beforeSend: function(){

},
           success:function(datos){
             if (datos==0) {
               alert(datos)
             }else {

           document.getElementById('response').innerHTML= datos;
           $("#lls").val("");
               $("#lll").val("");
               $("#ddate").val("");
             }

           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}
function mostrars() {
  $.ajax({
           type:'POST',
           url:"php/mostrars.php",
           dataType:'HTML',
           data:{

           },
           beforeSend: function(){

          },
           success:function(datos){
              $("#soli").html(datos);
           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}
function buscar() {
  $.ajax({
           type:'POST',
           url:"php/buscar.php",
           dataType:'HTML',
           data:{
            s:$("#lds").val(),
            l:$("#ldl").val()
           },
           beforeSend: function(){

          },
           success:function(datos){
              if (datos==0) {
               window.alert("no hay con esas rutas" );
             }else{
               $("#v_populares").html("");
                $("#v_populares").html(datos);
             }
           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}
function embarcar(id){
  if(document.getElementById("p_cupos").length==0){
      alert("Cupos cerrado");
  }else{
    var op_pc=  document.getElementById("p_cupos").selectedIndex;
    var dato={"id":id.id,"cupos":document.getElementsByTagName("option")[op_pc].value};
      //alert(document.getElementsByTagName("option")[op_pc].value);
    $.ajax({
               type:'POST',
               url:"php/embarcar.php",
               dataType:'HTML',
               data:dato,
               beforeSend: function(){

              },
               success:function(datos){
                 var respuesta=(JSON.parse(datos));
                 if(respuesta[0]==false){
                    window.alert(respuesta[1]);
                 }else if(respuesta[0]=true){
                   window.alert(respuesta[1]);
                 }
                 //document.getElementById("v_populares").innerHTML=datos;
               },
               error: function ( jqXHR, textStatus, errorThrown ){
                    alert (errorThrown);
               }
         });
  }
}

function subirme(id){

	var dato={"id":id.id};

   $.ajax({
           type:'POST',
           url:"php/subirme.php",
           dataType:'HTML',
           data:dato,
           beforeSend: function(){

          },
           success:function(datos){
           	if(datos==""){
           		window.alert("Debe iniciar sesión");
           	}else{
           		document.getElementById("v_populares").innerHTML="";
           		document.getElementById("v_populares").innerHTML=datos;
           	}
             // window.alert(datos);

           },
           error: function ( jqXHR, textStatus, errorThrown ){
                alert (errorThrown);
           }

     });
}

function validar() {
   if ($("")) {

   }
}
