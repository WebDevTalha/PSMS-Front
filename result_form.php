<?php
require_once('config.php');
session_start();

$captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
$getcaptcha_num = substr(str_shuffle($captcha_num), 0, 6);

if(isset($_POST['submit_btn'])){
   $examination = $_POST['examination'];
   $year = $_POST['year'];
   $class = $_POST['class'];
   $type = $_POST['type'];
   $mobile = $_POST['mobile'];
   $captchaCode = $_POST['captchaCode'];
   $captcha = $_POST['captcha'];

   
   // Student Count
   $st_count = pfRowCount('mobile',$mobile);
   
   // Student id
   $st_id = studentIdFormMobile('id',$mobile);

   
   $st_class_id = studentClass('current_class',$st_id);

   if($examination == 0){
      $error = "Choose Examination!";
   }
   else if($examination == 1){
      $error = "First Term Exam Not Published!";
   }
   else if($examination == 2){
      $error = "Second Term Exam Not Published!";
   }
   else if($year != 2022){
      $error = "This Year Result Not Published!";
   }
   else if($year != 2022){
      $error = "This Year Result Not Published!";
   }
   else if($class != $st_class_id){
      $error = "Select VAlid Class!";
   }
   else if($type == 0){
      $error = "Select Result Type!";
   }
   else if(empty($mobile)){
      $error = "Mobile Number Is Requird!";
   }
   else if($st_count != 1){
      $error = "Student Not Found!";
   }
   else if($captcha != $captchaCode){
      $error = "Captcha Dosn't Match!";
   }
   else{

      // Result Count
      $resultCount = resultCount($st_id);

      if($resultCount == 1){
         $stm=$pdo->prepare("SELECT * FROM students_results WHERE st_id=?");
         $stm->execute(array($st_id));
         $result = $stm->fetchAll(PDO::FETCH_ASSOC);

         $_SESSION['st_result'] = $result;

         header("location:result_show.php");
      }
      else{
         $error = "Student Result Not Found!";
      }
   }

}

if(isset($_SESSION['st_result'])){
   header("location:result_show.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="PSMS : Primary School Manegment System" />
	
	<!-- OG -->
	<meta property="og:title" content="PSMS : Primary School Manegment System" />
	<meta property="og:description" content="PSMS : Primary School Manegment System" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS : Primary School Manegment System</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
	
	<!-- REVOLUTION SLIDER CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/navigation.css">
	<!-- REVOLUTION SLIDER END -->	
   <!-- fontawsome css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body id="bg" class="result-body">
<div class="page-wraper">
   
   <div class="section">
      <div class="container">
         <div class="wrapper">
            <div class="row align-items-center">
               <div class="col-md-8 offset-md-2">
                  <!-- Header Area -->
                  <div class="header-area m-2 bg-primary">
                     <div class="row">
                        <div class="col-md-2">
                           <div class="logo">
                              <img src="assets/images/bd_logo.png" alt="bd-logo">
                           </div>
                        </div>
                        <div class="col-md-10">
                           <div class="header-content text-center">
                              <h1>WEB BASED RESULT PUBLICATION SYSTEM FOR PSMS</h1>
                              <h2>PRIMARY SCHOOL MANAGEMENT SYSTEM EQUIVALENT EXAMINATION</h2>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Body Area -->
                  <div class="body-area mx-2">
                     <div class="result-info">
                        <?php if(isset($error)) :?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif;?>
                        <div class="card">
                           <div class="resunt-info-head">
                              <p>Please provide information for result</p>
                              <a href="index.php" class="btn">Home</a>
                           </div>
                           <div class="card-body">
                              <form action="" method="POST">
                                 <!-- Single Form Group -->
                                 <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                       <div class="col-md-6">
                                          <label for="examination">Examination</label>
                                       </div>
                                       <div class="col-md-6">
                                          <select name="examination" class="form-control rounded" id="examination">
                                             <option value="0">Choose One</option>
                                             <option <?php if(isset($_POST['examination']) && $_POST['examination'] == 1){echo "selected";} ?> value="1">First Term Exam</option>
                                             <option <?php if(isset($_POST['examination']) && $_POST['examination'] == 2){echo "selected";} ?> value="2">Second Term Exam</option>
                                             <option <?php if(isset($_POST['examination']) && $_POST['examination'] == 3){echo "selected";} ?> value="3">final Exam</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Single Form Group -->
                                 <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                       <div class="col-md-6">
                                          <label for="year">Year</label>
                                       </div>
                                       <div class="col-md-6">
                                          <select id="year" name="year" class="form-control rounded">
                                             <option value="0">Choose One</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2022){echo "selected";} ?> value="2022">2022</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2021){echo "selected";} ?> value="2021">2021</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2020){echo "selected";} ?> value="2020">2020</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2019){echo "selected";} ?> value="2019">2019</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2018){echo "selected";} ?> value="2018">2018</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2017){echo "selected";} ?> value="2017">2017</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2016){echo "selected";} ?> value="2016">2016</option>
                                             <option <?php if(isset($_POST['year']) && $_POST['year'] == 2015){echo "selected";} ?> value="2015">2015</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Single Form Group -->
                                 <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                       <div class="col-md-6">
                                          <label for="class">Class</label>
                                       </div>
                                       <div class="col-md-6">
                                          <select id="class" name="class" class="form-control rounded">
                                             <option value="0">Choose One</option>
                                             <?php  
                                                $stm = $pdo->prepare("SELECT id,class_name FROM class ORDER BY class_name ASC");
                                                $stm->execute();
                                                $classList = $stm->fetchAll(PDO::FETCH_ASSOC);
                                                $i=1;
                                                foreach($classList as $list) :
                                             ?>
                                             <option
                                             <?php 
                                             if(isset($_POST['class']) AND $_POST['class'] == $list['id']){
                                                echo "selected";
                                             }
                                             ?>
                                             value="<?php echo $list['id'];?>"><?php echo $list['class_name'];?></option>
                                             <?php endforeach;?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Single Form Group -->
                                 <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                       <div class="col-md-6">
                                          <label for="type" class="text-danger">Result Type</label>
                                       </div>
                                       <div class="col-md-6">
                                          <select id="type" name="type" class="form-control rounded">
                                             <option value="0">Choose One</option>
                                             <option value="1">Individual Result</option>
                                             <option value="2">Institution Result</option>
                                             <option value="4">Center Result</option>
                                             <option value="5">District Result</option>
                                             <option value="6">Institution Analytics</option>
                                             <option value="7">Board Analytics</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Single Form Group -->
                                 <div class="roll_capcha">

                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

    <!-- Footer END ==== -->
    <button class="back-to-top fa fa-chevron-up" ></button>
</div>

<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script> -->
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/contact.js"></script>
</body>

</html>

<script>
    $('#type').change(function(){
        let type_id = $(this).val();
        if(type_id == 1){
         $.ajax({
            type: "POST",
            url:'ajax.php',
            data: {
               type_id:type_id
            },
            success:function(response){
                let data = response;
                console.log(data);
                $('.roll_capcha').html(data); 
            }
         });  
        }
    });
</script>