<?php
  /**
   *
   */
  class GoogleAuth{
        protected $client;
    function __construct(Google_Client $googleClient=null){
        $this->client=$googleClient;
        if ($this->client){
              $this->client->setClientId('781484041395-ro4n6a0so9sp3d2704641sfdu9b8msbr.apps.googleusercontent.com');
              $this->client->setClientSecret('NXWNsjbe-T9s7ntt9dx3DDCf');
              $this->client->setRedirectUri('http://localhost/smv/index.php');
              $this->client->setScopes('email');
        }
    }
    public function isLoggedIn(){
      return isset($_SESSION['access_token']);
    }
    public function getAuthUrl(){
      return $this->client->createAuthUrl();
    }
    public function checkRedirectCode(){
      if(isset($_GET['code'])){
        $this->client->authenticate($_GET['code']);
        $this->setToken($this->client->getAccessToken());
        session_start();
        $payload= $this->pres();
        $_SESSION["bil"]=$payload;

        return true;
      }
      return false;
    }
    public function setToken($token){
      $_SESSION['access_token']=$toke;
      $this->client->setAccessToken($token);
    }
    public function pres(){
      $id_token=getAccessToken();
      $client = new Google_Client(['client_id' => $CLIENT_ID]);
      $payload = $client->verifyIdToken($id_token);
      if ($payload) {
        $userid = $payload['sub'];
        // If request specified a G Suite domain:
        //$domain = $payload['hd'];
      } else {
        // Invalid ID token
      }
      return$userid;
    }
    public function getPayload(){
        //$payload="getAccessToken()";
      //$payload = $this->client->verifyIdToken()->getAttributes();

      return $payload;
    }
  }

?>
