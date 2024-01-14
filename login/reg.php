<?php
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST["submit"])) {
include('include/db2.php');

$mail = new PHPMailer();
$mail->Encoding = "base64";
$mail->SMTPAuth = true;
$mail->Host = "smtp.zeptomail.com";
$mail->Port = 587;
$mail->Username = "emailapikey";
$mail->Password = 'wSsVR60k/h/zCal/zTf/Lu07nlpVVV+jFxx1iQPyunP6Sq3F9sdpwxfKUQb0GPdJEWBrHGZHrb8smxYBhzQO2tokn1kJDiiF9mqRe1U4J3x17qnvhDzDWG9elxCLKoMAxgpsmWhlEs4n+g==';
$mail->SMTPSecure = 'TLS';
$mail->isSMTP();
$mail->IsHTML(true);
$mail->CharSet = "UTF-8";
$mail->From = "noreply@asuu.org.ng";
$mail->addAddress($_POST["email"]);
$mail->Subject="Author's Registrations";
$mail->SMTPDebug = 0;
$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str"; echo "<br>";};


  //Authentication
  $fname = trim($_POST["fname"]);
  $onames = trim($_POST["onames"]);
  $phone = trim($_POST["phone"]);
  $email = trim($_POST["email"]);
  $ranpass = rand();
  $ddpass = md5($ranpass);
  $institution = trim($_POST['institution']);
  $user_role = 'Author';
  $redirect = '/author';

  $sql = "SELECT COUNT(*) AS count from ejournal_users where email = :email";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else {


      $sql = "INSERT INTO `ejournal_users` (`fname`,`onames`,`phone`,`email`,`password`,`institution`,`user_role`,`redirect`) VALUES " . "( :fname,:onames, :phone, :email , :password, :institution, :user_role, :redirect)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":fname", $fname);
      $stmt->bindValue(":onames", $onames);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":password", $ddpass);
      $stmt->bindValue(":institution", $institution);
      $stmt->bindValue(":user_role", $user_role);
      $stmt->bindValue(":redirect", $redirect);
      $stmt->execute();
      $result = $stmt->rowCount();

      if ($result > 0) {

        $lastID = $DB->lastInsertId();
        try {
          // Mail Body
          $mail->Body ="<html><head><title>ASUU - Journal</title></head><body>
          <h2>Hello  $fname </h2>
          <p> Thank you for Signing up with Academic Staff Union of Universities E-journal, we are happy to have you here.</p>
         
          <p> Here are you login credencials
            <ul> 
            <li><a href='https://ejournals.asuu.org.ng/login/'>Click here to Login</a></li>
            <li>Username : $email </li>
            <li>Password : $ranpass </li>
            </u>
          </p>
          <br>
          <p>Thank you, <br> Ejournal Academic Staff Union of Universities</p>
          </body></html>";
          $mail->send();
          $msg2 = "An email has been sent to your email.";
          $msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
        }
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include('include/reg_head.php'); ?>
</head>

<body>
  <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
    <div class="login-box bg-white box-shadow pd-30 border-radius-5">
      <img src="vendors/images/login-img.png" alt="login" class="login-img">
      <h2 class="text-center mb-20">Author's Registration</h2>
      <?php

      if (isset($msg)) {
        echo "<div class='alert alert-danger'><strong>Error: $msg </strong> </div>";
      } else {
        if (isset($msg2))
          echo "<div class='alert alert-success'><strong> $msg2 </strong> </div>";
      }

      ?>
      <form method="post" action="#">
        <p></p>

        <div class="input-group custom input-group-lg">
          <input type="text" class="form-control" placeholder="First Name" name="fname" required />
          <div class="input-group-append custom">
            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
          </div>
        </div>
        <div class="input-group custom input-group-lg">
          <input type="text" class="form-control" placeholder="Other Names" name="onames" required>
          <div class="input-group-append custom">
            <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
          </div>
        </div>
        <div class="form-group">
          <select class="form-select custom-select" aria-label="Default select example" name="institution" required>
            <option selected>----Institution----</option>
            <option value="Delta State University">Delta State University, Abraka</option>
            <option value="Ebonyi State University">Ebonyi State University, Abakaliki</option>
            <option value="Ekiti State University">Ekiti State University, Ado-Ekiti</option>
            <option value="Enugu State University of Science and
                        Technology">Enugu State University of Science and
              Technology, Enugu</option>
            <option value="Gombe State Univeristy">Gombe State Univeristy, Gombe</option>
            <option value="Ibrahim Badamasi Babangida University">Ibrahim Badamasi Babangida University. Lapai</option>
            <option value="Ignatius Ajuru University of Education">Ignatius Ajuru University of Education, Port-Harcourt</option>
            <option value="Imo State University">Imo State University, Owerri </option>
            <option valaue="Kaduna State University">Kaduna State University, Kaduna</option>
            <option value="Kano University of Science & Technology">Kano University of Science & Technology, Wudil</option>
            <option value="Kebbi State University">Kebbi State University, Kebbi</option>
            <option value="Kogi State University">Kogi State University, Anyigba</option>
            <option value="Ladoke Akintola University of Technology">Ladoke Akintola University of Technology,Ogbomoso</option>
            <option value="Lagos State University Ojo">Lagos State University Ojo, Lagos.</option>
            <option value="Nasarawa State University">Nasarawa State University, Keffi</option>
            <option value="Niger Delta Unversity">Niger Delta Unversity, Yenagoa</option>
            <option value="Olabisi Onabanjo University">Olabisi Onabanjo University, Ago-Iwoye</option>
            <option value="Osun State University">Osun State University, Oshogbo</option>
            <option value="Rivers State University of Science & Technology">Rivers State University of Science & Technology, Port-Harcourt</option>
            <option value="Tai Solarin University of Education">Tai Solarin University of Education, Ijebu -Ode</option>
            <option value="Taraba State University">Taraba State University, Jalingo</option>
            <option value="Umaru Musa Yar'Adua University">Umaru Musa Yar'Adua University, Katsina</option>
            <option value="Sokoto State University">Sokoto State University, Sokoto</option>
            <option value="Kwara State University">Kwara State University, Malete</option>
            <option value="Ondo State University of Science and Technology">Ondo State University of Science and Technology, Okitipupa</option>
            <option value="Bauchi State University">Bauchi State University, Gadau</option>
            <option value="Plateau State University (PLASU)">Plateau State University (PLASU), Bokkos</option>
            <option value="North-West University Kano (NUK)">North-West University Kano (NUK)</option>
            <option value="Sule lamido University">Sule lamido University</option>
            <option value="Abia State University">Abia State University, Uturu.</option>
            <option value="Adamawa State University">Adamawa State University, Mubi</option>
            <option value="AdekunleAjasin University">AdekunleAjasin University, Akungba</option>
            <option value="Ambrose Alli University">Ambrose Alli University, Ekpoma</option>
            <option value="Akwa Ibom State University">Akwa Ibom State University</option>
            <option value="Chukwuemeka Odumegwu Ojukwu University">Chukwuemeka Odumegwu Ojukwu University</option>
            <option value="Benue State University">Benue State University, Makurdi.</option>
            <option value="Bukar Abba Ibrahim University">Bukar Abba Ibrahim University, Damaturu.</option>
            <option value="Cross River State University of Science
                        &Techno1ogy">Cross River State University of Science
              &Techno1ogy, Calabar</option>
            <option value="Obafemi Awolowo University">Obafemi Awolowo University,Ile-Ife</option>
            <option value="University of Abuja">University of Abuja, Gwagwalada</option>
            <option value="University of Agriculture">University of Agriculture, Abeokuta.</option>
            <option value="University of Agriculture">University of Agriculture, Makurdi.</option>
            <option value="University of Benin">University of Benin. Benin</option>
            <option value="University of Calabar">University of Calabar, Calabar</option>
            <option value="University of Ibadan">University of Ibadan, Ibadan</option>
            <option value="University of Ilorin">University of Ilorin, Ilorin</option>
            <option value="University of Jos">University of Jos, Jos</option>
            <option value="University of Lagos">University of Lagos, Lagos</option>
            <option value="University of Maiduguri">University of Maiduguri, Maiduguri</option>
            <option value="University of Port-Harcourt">University of Port-Harcourt, Port-Harcourt</option>
            <option value="University of Nigeria">University of Nigeria, Nsuklca</option>
            <option value="University of Uyo">University of Uyo, Uyo</option>
            <option value="Usmanu Danfodiyo University">Usmanu Danfodiyo University, Sokoto</option>
            <option value="Federal University Dutse">Federal University Dutse</option>
            <option value="Federal University Kashere">Federal University Kashere</option>
            <option value="Federal University">Federal University, Lafia</option>
            <option value="Federal University, OyeEkiti (FUOYE)">Federal University, OyeEkiti (FUOYE)</option>
            <option value="Federal University, Otuoke">Federal University, Otuoke</option>
            <option value="Federal University, Ndufe Alike-Ikwo">Federal University, Ndufe Alike-Ikwo</option>
            <option value="Federal University, Dutsin-Ma">Federal University, Dutsin-Ma</option>
            <option value="Federal University, Lokoja">Federal University, Lokoja</option>
            <option value="Abubakar Tafawa Balewa University">Abubakar Tafawa Balewa University, Bauchi</option>
            <option value="Ahmadu Bello University, Zaria">Ahmadu Bello University, Zaria</option>
            <option value="Bayero University">Bayero University, Kano</option>
            <option value="Federal University of Technology Akure">Federal University of Technology Akure</option>
            <option value="Federal University of Technology">Federal University of Technology, Minna.</option>
            <option value="Federal University of Technology">Federal University of Technology, Oweni</option>
            <option value="Michael Opara University, of Agic.">Michael Opara University, of Agic., Umudike</option>
            <option value="Modibbo Adama University of Technology">Modibbo Adama University of Technology, Yola</option>
            <option value="Nnamdi Aziliwe University, Awla">Nnamdi Aziliwe University, Awla</option>
    </select>
        </div>
        <div class="input-group custom input-group-lg">
          <input type="phone" class="form-control" placeholder="Mobile Number" name="phone" required>
          <div class="input-group-append custom">
            <span class="input-group-text"><i class="fa fa-phone" aria-hidden="true"></i></span>
          </div>
        </div>
        <div class="input-group custom input-group-lg">
          <input type="email" class="form-control" placeholder="Email address" name="email" required>
          <div class="input-group-append custom">
            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="input-group">
              <input class="btn btn-primary btn-lg btn-block" type="submit" value="Register" name="submit">
            </div>
          </div>
          <div class="col-sm-6 text-right pt-2">

            <h7>
              <a style="color:#ED2F59; margin-left: -80px;" href="reg.php"> |</a> <a style="color:#ED2F59; margin-right: -10px;" href="https://ejournals.asuu.org.ng/login/">Back to Login</a>



            </h7>
          </div>
        </div>

      </form>
      <div class="col-md-12">
        <div class="text-center">
          <ul class="u_ab">
            <li class="li_ab">

              <br />
              <a class="a_ab" href="https://ejournals.asuu.org.ng/">
                <i class="fa fa-home i_ab" aria-hidden="true"></i>
                <strong>Go to Home</strong>
              </a>

            </li>
          </ul>
          <div>
          </div>
        </div>
      </div>


      <?php include('include/script.php'); ?>
</body>

</html>