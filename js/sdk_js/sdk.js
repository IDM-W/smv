var img;
 var nombre;
 var idd;
        window.onload=function() {
         FB.init({
           appId      : '1185459628242040',
           status     : true,
           xfbml      : true,
           version    : 'v2.7'
         });


       };

          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
          console.log( "hola"  );

        }(document, 'script', 'facebook-jssdk'));




         function initfa() {
           FB.login(function(response) {
               if (response.status === 'connected') {
                 los();
                 ll1();
                 } else {
                        alert("No has iniciado sesion co esta app");

                 }
                });

         }


function los() {
   FB.api("/me/picture?width=100&height=100", function(response) {
   console.log(response.data.url );
   img= response.data.url;
   localStorage.setItem("img",img);


});
}

function ll1() {
  var url = '/me?fields=name,email,first_name,last_name';
   FB.api(url, function (response) {
   nombre=response.name;
   idd=response.id;
   fi=response.first_name +" " +response.last_name;
   localStorage.setItem("id_fa", idd);
   localStorage.setItem("nombre", fi);
   localStorage.setItem("nombre_com", nombre);
  ajax();
 });

}
function ajax() {
  img=localStorage.getItem("img");
  fi=localStorage.getItem("nombre");
  nc=localStorage.getItem("nombre_com");
  idd=localStorage.getItem("id_fa");





  $.ajax({

      url: 'php/exephp/login_f.php',
      type: "POST",
      data: {
        iden:idd,
        fir:fi,
        nombre:nc,
        im:img
           },
      success: function(datos)
      {
          if (datos==0) {
            location.href="info.php";
          }else{
            localStorage.clear();
            location.href="inicio.php";
          }
      }
  });
}
