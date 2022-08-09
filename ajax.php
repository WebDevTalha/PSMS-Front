<?php

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