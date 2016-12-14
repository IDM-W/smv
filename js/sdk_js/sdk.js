var img;
 var nombre;
 var id;
        window.onload=function() {
         FB.init({
           appId      : '1185459628242040',
           xfbml      : true,
           version    : 'v2.8'
         });
       };

          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


         function initfa() {
           FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
              los();
              ll1();
              } else {
                  FB.login(function(response) {
                  if (response.status === 'connected') {

                  } else if (response.status === 'not_authorized') {
                     alert("No autorizado");
                  } else {
                     alert("No has iniciado sesion co esta app");
                  }
                },{scope:'public_profile,email'});
              }
                });

         }
        function los() {
           FB.api("/me/picture?width=100&height=100", function(response) {
           console.log(response.data.url );
           img= response.data.url;
        });
        }

        function ll1() {
          var url = '/me?fields=name,email';
           FB.api(url, function (response) {
           nombre=response.name;
           id=response.id;
           window.alert( nombre+" "+id );

         });
    }
