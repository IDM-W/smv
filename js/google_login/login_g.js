
var googleUser = {};
var startApp = function() {
  gapi.load('auth2', function(){
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id: '750505495079-notv4s5fhnkfpt3en0q88q3eqmjs0vth.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      //Request scopes in addition to 'profile' and 'email'
      scope: 'email'
    });
    attachSignin(document.getElementById('login_google'));
  });
};

function attachSignin(element) {
  auth2.attachClickHandler(element, {},
      function(googleUser) {
        var url="php/google_log/login_g.php";
        var data ={
                  'image':googleUser.getBasicProfile().getImageUrl(),
                  'id':googleUser.getBasicProfile().getId(),
                  'email':googleUser.getBasicProfile().getEmail(),
                  'name':googleUser.getBasicProfile().getName()
                  };
        console.log(googleUser.getBasicProfile().getName()+googleUser.getBasicProfile().getEmail()+ googleUser.getBasicProfile().getImageUrl()+googleUser.getBasicProfile().getId());
        enviar_php.datasend(data,url);
      }, function(error) {
        alert(JSON.stringify(error, undefined, 2));
      });
}

startApp();
