<?php
require_once("header.php");


$user_id = $_SESSION['st_logedin'][0]['id'];

$stm = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stm->execute(array($user_id));
$student_list = $stm->fetchAll(PDO::FETCH_ASSOC);





?>



<style>
   
.bkash-logo {
  padding-bottom: 20px;
  position: relative;
  margin-bottom: 30px;
}
.bkash-logo::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 5px;
  background: #E3106E;
}
.invoice {
  display: flex;
  gap: 13px;
  align-items: center;
}
.invoice-content p {
  margin: 0;
}
.invoice-content p:first-child {
  font-weight: 700;
  color: #fd9a30;
}
.price p {
  font-size: 40px;
  margin: 0;
  text-align: right;
}
.payment-form {
  padding: 60px 0px 0px 0px;
  background: url(assets/images/input_bg.png);
  color: #fff;
  text-align: center;
}
.payment-form input {
  padding: 15px 69px;
  text-align: center;
  border: none;
  outline: none;
  font-weight: 500;
  color: #484646;
  margin-bottom: 75px;
}
.call-btn {
  text-align: center;
  margin-top: 28px;
}
.b-buttons {
  display: grid;
  grid-template-columns: 50% 50%;
}
.b-buttons * {
  background: #ddd;
  color: #000;
  border: none;
  outline: none;
  padding: 17px;
  font-weight: 600;
  text-transform: uppercase;
  transition: .3s;
}

.b-buttons *:hover {
  color: #939191;
}
.b-buttons a {
  text-decoration: none;
  color: #fff;
  border-right: 1px solid #c6c1c1;
}
.call-btn a {
  text-decoration: none;
  color: #E3106E;
  font-size: 30px;
}
.b-buttons span {
  cursor: pointer;
}



/* Preloader */

.preloader-bg {
    position: absolute;
    background-color: #fff;
    width: 94%;
    height: calc(590px - 100px);
    z-index: 5;
    top: 115px;
    left: 20px;
}

.center{
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
}

.bouncywrap{
  position: relative;
}


.dotcon{
  display: block;
  float: left;
  width: 50px;
  position: absolute;
}

.dc1{
  -webkit-animation: bouncy1 1.2s infinite;
  left: -40px;
  animation: bouncy1 1.2s infinite;
}

.dc2{
  -webkit-animation: bouncy2 1.2s infinite;
  animation: bouncy2 1.2s infinite;
  left: 0;
}

.dc3{
  -webkit-animation: bouncy3 1.2s infinite;
  animation: bouncy3 1.2s infinite;
  left: 40px;
}

.dot{
  height: 10px;
  width: 10px;
  border-radius: 50%;
  background: #E3106E;
}


@-webkit-keyframes bouncy1{
  0% {-webkit-transform: translate(0px,0px) rotate(0deg);}
  50% {-webkit-transform: translate(0px,0px) rotate(180deg);}
  100% {-webkit-transform: translate(40px,0px) rotate(-180deg);}
}

@keyframes bouncy1{
  0% {transform: translate(0px,0px) rotate(0deg);}
  50% {transform: translate(0px,0px) rotate(180deg);}
  100% {transform: translate(40px,0px) rotate(-180deg);}
}

@-webkit-keyframes bouncy2{
  0% {-webkit-transform: translateX(0px);}
  50% {-webkit-transform: translateX(-40px);}
  100% {-webkit-transform: translateX(-40px);}
}

@keyframes bouncy2{
  0% {transform: translateX(0px);}
  50% {transform: translateX(-40px);}
  100% {transform: translateX(-40px);}
}

@-webkit-keyframes bouncy3{
  0% {-webkit-transform: translateX(0px);}
  50% {-webkit-transform: translateX(0px);}
  100% {-webkit-transform: translateX(-40px);}
}

@keyframes bouncy3{
  0% {transform: translateX(0px);}
  50% {transform: translateX(0px);}
  100% {transform: translateX(-40px);}
}

.full_wrapper {
   margin-top: 90px;
}

</style>


<div class="full_wrapper">
<div class="row">
    <div class="col-md-6 grid-margin stretch-card offset-md-4">
    
    <?php if(isset($error)) :?>
    <div class="alert alert-danger"><?php echo $error;?></div>
    <?php endif;?>
    <?php if(isset($success)) :?>
    <div class="alert alert-success"><?php echo $success;?></div>
    <?php endif;?>
        <div class="card">
            <div class="card-body">
               <div class="wrapper">
                  <div class="bkash-logo text-center">
                     <img src="assets/images/bkash_payment.png" alt="Bkash" class="w-50">
                  </div>
                  <!-- price -->
                  <div class="invoice-n-price">
                     <div class="row align-items-center mb-3">
                        <div class="col-md-6">
                           <div class="invoice">
                              <div class="web-logo">
                                 <img src="assets/images/psms.png" alt="PSMS" class="rounded">
                              </div>
                              <div class="invoice-content">
                                 <p>PSMS</p>
                                 <p>Name: <?php echo $student_list[0]['name']; ?></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="price">
                              <p class="amount_t"></p>
                           </div>
                        </div>
                     </div>
                     <form class="payment-form" action="" method="POST">
                        <p>Your Bkash Account Number (<?php echo hideMobile($student_list[0]['mobile']); ?>)</p>
                        <input type="text" name="amount" id="numberFormate" placeholder="Enter Amount" value="" autocomplete="off">
                        <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                        <div class="b-buttons">
                           <a href="teacher_payment.php">Close</a>
                           <span id="submit_amount_btn">Confirm</span>
                        </div>
                     </form>
                     <div class="call-btn">
                        <a href="tel:16247"><i class="fa-solid fa-phone"></i> 16247</a>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="delete_popup">
    <p class="error_text"></p>
    <span class="text-sm">  </span>
    <div class="row">
        <div class="col-sm-6 offset-sm-3"><a href="#" class="btn btn-success close_btn">Try Again</a></div>
    </div>
</div>
<div class="overlay"></div>

<?php require_once("footer.php"); ?>


<script>

function popupOpen(){
    $('.delete_popup, .overlay').show(500);
};

function popupClose(){
  $('.close_btn').click(function(){
    $('.delete_popup, .overlay').hide(0);
  });
};

// Add Comma In Input
// $("#numberFormate").keyup(function(event){
//     // skip for arrow keys
//     if(event.which >= 37 && event.which <= 40){
//         event.preventDefault();
//     }
//     var $this = $(this);
//     var num = $this.val().replace(/,/gi, "")
//         .split("").reverse().join("");
      
//     var num2 = RemoveRougeChar(
//         num.replace(/(.{3})/g,"$1,").split("")
//             .reverse().join("")
//     );
      
//     $this.val(num2);
// });
// function RemoveRougeChar(convertString){
//   if(convertString.substring(0,1) == ","){
//     return convertString.substring(1, convertString.length)            
//   }
//   return convertString;
// }
   
$('#submit_amount_btn').click(function(){
    let amount = $('#numberFormate').val();  
    let user_id = $('#user_id').val();  
    if(amount == ""){
      popupOpen();
      popupClose();
      $('.error_text').text('Amount is required for payment!');
    }
    else{
      // console.log(amount);
      $.ajax({
          type: "POST",
          url:'../ajax.php',
          data: {
            amount: amount,
            user_id: user_id
          },
          success:function(response){
              let data = response;
              console.log(data);
              $('.full_wrapper').html(data); 
              
              const loader = document.getElementById("preloader-bg");
              setTimeout(function(){
                loader.style.display = 'none';
              }, 3000);
          }
      });  
    }
});


$(document).on('keypress',function(e) {
    if(e.which == 13) {
      $('#submit_amount_btn').click();
    }
});

 


</script>


<?php


// if(isset($_POST['submit_amount_btn'])){

//   $amount = $_POST['amount'];

//   if(empty($amount)){
//     echo "<script>
//     popupOpen();
//     popupClose();
//     $('.error_text').text('Amount is required for payment!');
//     </script>";
//   }
//   else{
//     $_SESSION['bkash_pay_number'] = $amount;

//   }

// }





if(isset($_POST['submit_btn'])){

  $pin = $_POST['pin'];
  $amount = $_POST['salary_amount'];
  $bkash = "Bkash";

  

  if(empty($pin)){
    echo "<script>
    popupOpen();
    popupClose();
    $('.error_text').text('Enter Your Dashboard Password!');
    </script>";
  }
  else{

   $stm = $pdo->prepare("SELECT password FROM students WHERE id=?");
   $stm->execute(array($user_id));
   $pass_count = $stm->fetchAll(PDO::FETCH_ASSOC);

    if(SHA1($pin) == $pass_count[0]['password']){
      $stm = $pdo->prepare("UPDATE students SET balance_send = balance_send + ?,last_amount = ? WHERE id = ?");
      $stm->execute(array($amount,$amount,$user_id));

      $insert = $pdo->prepare("INSERT INTO student_payment_history(
        student_id,
        amount,
        payment_method
      ) VALUES(?,?,?)");
      $insert->execute(array($user_id,$amount,$bkash));

      $insert2 = $pdo->prepare("INSERT INTO notification(
        type,
        st_id
      ) VALUES(?,?)");
      $insert2->execute(array("st_pay",$user_id));
  
      echo "<script>
      swal({
        title: 'Success!',
        text: 'Payment Successfyly Send!',
        icon: 'success',
        button: 'Ok!',
      });
      </script>";
    }
    else {
      echo "<script>
      popupOpen();
      popupClose();
      $('.error_text').text('Your Dashboard Password Not Match!');
      </script>";
    }

  }

}





?>