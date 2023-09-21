
<?php
// Secret Key ini kita ambil dari halaman Google reCaptcha
// Sesuai pada catatan saya di STEP 1 nomor 6
$secret_key = "6Lfe1j8oAAAAAOCd3l6uT9TUvliT66X_bu3cgtQR";
// Disini kita akan melakukan komunkasi dengan google recpatcha
// dengan mengirimkan scret key dan hasil dari response recaptcha nya
$verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
$response = json_decode($verify);
if($response->success){ // Jika proses validasi captcha berhasil
      $con=new PDO("mysql:host=localhost;dbname=tokobangunan","root","");

      if (isset($_POST['login'])){
            $user=$_POST['username'];
            $pass=$_POST['password'];
      
            $query=$con->prepare("select * from login where username=:username and password=:password");
            $query->BindParam(":username",$user);
            $query->BindParam(":password",$pass);
            $query->execute();
            if ($query->rowCount()>0){
                  session_start();
                  $data=$query->fetch();
                  if($data['level']=="admin"){
                        $_SESSION['username']=$data['username'];
                        $_SESSION['level']=$data['level'];
                        header('location:index.php');
                  }else{
                        $_SESSION['username']=$data['username'];
                        $_SESSION['level']=$data['level'];
                        header('location:index.php');
                  }
            }
            else{
                  echo '<script>alert("username dan password tidak valid");window.location="login.php"</script>';
            }
      }
}else{ // Jika captcha tidak valid
      echo '<script>alert("Kamu Bukan Manusia Ya ?");window.location="login.php"</script>';
      
      
}
?>