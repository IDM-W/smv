function agr() {
  img=localStorage.getItem("img");
  fi=localStorage.getItem("nombre");
  nc=localStorage.getItem("nombre_com");
  id=localStorage.getItem("id_fa");
  localStorage.clear();
  c=0;
   if ($('#email').val().length<1) {
      window.alert( "ingrese email es oblgatorio" );
       $("#email").focus();

   }else{
     c=c+1;
   }
     if (c==1) {
       if ($('#tele').val().length<1) {
          window.alert( "ingrese tele es oblgatorio" );
           $("#tele").focus();
           c=c+1;
       }else{
         c=c+1;
       }
   }

  if (c==2) {
    $.ajax({
        url: 'php/exephp/face.php',
        type: "POST",
        data: {
          iden:id,
          email:$("#email").val(),
          tele:$("#tele").val(),
          fir:fi,
          nombre:nc,
          im:img
             },
        success: function(datos)
        {
          window.alert( datos );

          if (datos==1) {
            location.href="inicio.php"
          }

        }
    });
  }
}
