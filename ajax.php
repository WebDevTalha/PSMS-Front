<?php
require_once('config.php');

$captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
$getcaptcha_num = substr(str_shuffle($captcha_num), 0, 6);

?>
<?php if(isset($_POST['type_id']) == 1) :?>
   <div class="form-group mb-3">
      <div class="row align-items-center">
         <div class="col-md-6">
            <label for="type">Mobile No.</label>
         </div>
         <div class="col-md-6">
            <input type="text" name="mobile" class="form-control">
         </div>
      </div>
   </div>
   <div class="form-group mb-5">
      <div class="row align-items-center">
         <div class="col-md-6">
            <div class="row">
               <div class="col-md-8">
                  <input type="text" id="captchaCode" name="captchaCode" class="text-center text-white form-control chaptcha" value="<?php echo $getcaptcha_num; ?>" readonly>
               </div>
               <div class="col-md-4">
                  <span class="reload_btn btn btn-primary form-control"><i class="fa-solid fa-rotate-right"></i></span>
               </div>
            </div>  
         </div>
         <div class="col-md-6">
            <input type="text" name="captcha" class="form-control" id="captcha">
         </div>
      </div>
   </div>
   <div class="form-group m-3 text-right">
      <input type="submit" name="submit_btn" value="Get Result" class="btn btn-success">
   </div>
   <?php endif;?>

<?php 

if(isset($_POST['amount'])) : ?>

<?php

// Get Bkash Number Amount
$user_id = $_POST['user_id'];

$stm5 = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stm5->execute(array($user_id));
$student_list = $stm5->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
       <div class="col-md-6 grid-margin stretch-card offset-md-4">
           <!-- preloader -->
            <div class="preloader-bg" id="preloader-bg">
               <div class="center">
               <div class="bouncywrap">
                     
                     <div class="dotcon dc1">
                     <div class="dot"></div>
                     </div>
                  
                     <div class="dotcon dc2">
                     <div class="dot"></div>
                     </div>
                  
                     <div class="dotcon dc3">
                     <div class="dot"></div>
                     </div>
               
               </div>
               </div>
            </div>
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
                              <p>৳ <?php echo $_POST['amount']; ?>.00</p>
                              </div>
                           </div>
                        </div>
                        <form class="payment-form" action="" method="POST">
                           <p>Your Bkash Account Number (<?php echo hideMobile($student_list[0]['mobile']); ?>)</p>
                           <input type="password" name="pin" placeholder="Enter Your Password">
                           <input type="hidden" name="salary_amount" value="<?php echo $_POST['amount']; ?>">
                           <div class="b-buttons">
                              <a href="teacher_payment.php">Close</a>
                              <button name="submit_btn" type="submit">Confirm</button>
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
<?php endif; ?>