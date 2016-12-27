function inset_tel(){
  //alert(document.getElementById("tele").value);
  var data ={'telefono':document.getElementById("tele").value
            };
  var url="php/google_log/login_g.php";
  enviar_php.datasend(data,url);
}
