function registro() {
  var conta =0;
      var valorr =false;
    var n;
        if($('#nombre').val().length<1){
          //document.getElementById('noti').style.display="block";
          alert("inserte Nombre");
          $('#nombre').focus();
          n=false;
        }else{
          n=true;
          conta=conta+1;
        }
        var em;
        if(n==true){
          re=/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
          if(!re.test($('#email').val().trim())){
        //document.getElementById('noti').style.display="block";
            alert("correo no valido");
            $('#email').val('');
            $('#email').focus();
            em=false;
          }
          else {
            em=true;
            conta=conta+1;
          }
        }
        var co;
        if (em==true) {
          if ($('#email').val().length<1) {
            document.getElementById('noti').style.display="block";
            lert("correo no valido");
           co=false;
          }else {
            co=true;
            conta=conta+1;
          }
          var cp;
        if (co==true) {
           if ($('#contrasena').val().length<1) {
             //document.getElementById('noti').style.display="block";
            alert("Inserte Contraseña");
    cp=false;
  }else {
    cp=true;
    conta=conta+1;
  }
        }
        var t;
        if (cp==true) {
          if ($('#ccon').val()==$('#contrasena').val()){
               conta=conta+1;
               t=true;
          }else {
            //document.getElementById('noti').style.display="block";
            alert("Contraseñas no coinciden ");
            t=false;
          }
        }
        if (t==true) {
          if ($('#telefono').val().length<1){
            //document.getElementById('noti').style.display="block";
            alert("telefono por favor ");

          }else {
            conta=conta+1;
          }
        }
      }
        if (conta!=6) {

        }else{
          $.ajax({
              url: 'php/exephp/regi.php',
              type: "POST",
              data: {
                correo:$("#email").val()
              },

              success: function(datos)
              {
                  if (datos==0) {
                    $("#noti").html("El correo ya existe");
                      $('#notificaciones').fadeIn('slow');
                      $("#notificaciones").attr("background-color","#ff0000");
                      $("#notificaciones").fadeOut(10000);
                  }else{
                       document.forms['r'].submit();
                  }
              }
          });

        }}

function login() {
   contador =0;
   veri=false;
   if ($("#us").val().length==0) {
     $("#noti").html("Infgrese Usuario");
       $('#notificaciones').fadeIn('slow');
       $("#notificaciones").attr("background-color","#ff0000");
       $("#notificaciones").fadeOut(10000);
   }else{
     contador=contador+1;
     veri=true;
   }if (veri==true) {
       if ($("#p").val().length==0) {
         $("#noti").html("Ingrese Contraseña");
           $('#notificaciones').fadeIn('slow');
           $("#notificaciones").attr("background-color","#ff0000");
           $("#notificaciones").fadeOut(10000);
       }else{
         contador=contador+1;
       }
   }
   if (contador==2) {
     $.ajax({
         url: 'php/exephp/lo.php',
         type: "POST",
         data: {
           correo:$("#us").val(),
           co:$("#p").val()
         },

         success: function(datos)
         {
             if (datos==0) {
               $("#noti").html("Usuario no existe");
                 $('#notificaciones').fadeIn('slow');
                 $("#notificaciones").attr("background-color","#ff0000");
                 $("#notificaciones").fadeOut(10000);
             }else{
                   document.forms['l'].submit();
             }
         }
     });


   }
}
function fade() {
    $('#op').fadeIn('slow');
    $("#opaco").fadeIn("slow");
    $('#opaco').height($(window).height());
}
function gufoss() {
  var archivos = document.getElementById("foto");
  var archivo = archivos.files[0];
		var data = new FormData();
   data.append('foto',archivo);

           var ruta = "php/foto.php";
           $.ajax({
               url: ruta,
               type: "POST",
               data: data,
               contentType: false,
               processData: false,
               success: function(datos){
                 //alert(datos);
                   if (datos==0) {
                     window.alert(datos+ "el archivo no es una imagen" );
                   }else{

                      $("#lls").val(datos);
                     //$("#fope").attr("src",datos);
                     $("#op").fadeOut();
                     $("#opaco").fadeOut();
                   }
               }
           });
}
function gufo(event) {
    if (!(window.File)) {
        console.log('La API File no está soportada para este navegador');
        return;
    }

    var file;
    var reader;
    var files = document.getElementById('foto').files;
     switch(files[0]["type"]){
       case "image/gif":
       case "image/jpeg":
       case "image/png":
       case "image/jpg":
         file = files[0];
         reader = new FileReader();
         reader.onloadend = onFileLoaded;
         reader.readAsDataURL(file);
       break;
       default:alert("Formato de archivo incorrecto");
     }

}

function onFileLoaded(event) {
    var dataurl= event.currentTarget.result.substr(0);
    var dato={"foto":dataurl}
    var ruta = "php/foto.php";
    $.ajax({
        url: ruta,
        type: "POST",
        data: dato,
        success: function(datos){
           //alert(datos);
            if (datos==0) {
              window.alert("el archivo no es una imagen" );
            }else{

              //$("#lls").val(datos);
              $("#fope").attr("src",datos);
              $("#op").fadeOut();
              $("#opaco").fadeOut();
            }
        }
    });
}
