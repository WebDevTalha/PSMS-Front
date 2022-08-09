<?php
require_once('config.php');
session_start();

$resultData = $_SESSION['st_result'];



$st_id = $resultData[0]['st_id'];
$subjects = $resultData[0]['subjects'];
$position = $resultData[0]['position'];

$stm = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stm->execute(array($st_id));
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

$father_name = $result[0]['father_name'];
$mother_name = $result[0]['mother_name'];
$birthday = $result[0]['birthday'];





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
   <style>
      .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
         padding: 8px;
         font-size: 13px;
      }
   </style>
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
                     <h1>Result Of Equivalent Examination Class 1 - 2022</h1>
                     <div class="search-print-option">
                        <a href="session_distroy.php">Search Again</a>
                        <a href="#" class="printMe">Print</a>
                     </div>
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered" width="100%">
                           <tbody>
                              <tr>
                                 <td>New Roll No</td>
                                 <td><?php echo $position; ?></td>
                                 <td>Registration No</td>
                                 <td>[NOT SHOWN]</td>
                              </tr>
                              <tr>
                                 <td>Name of Student</td>
                                 <td colspan="3"><?php echo $resultData[0]['st_name']; ?></td>
                              </tr>
                              <tr>
                                 <td>Father's Name</td>
                                 <td colspan="3"><?php echo $father_name; ?></td>
                              </tr>
                              <tr>
                                 <td>Mother's Name</td>
                                 <td colspan="3"><?php echo $mother_name; ?></td>
                              </tr>
                              <tr>
                                 <td>District</td>
                                 <td>DINAJPUR</td>
                                 <td>Session</td>
                                 <td>2021-22</td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td>Type: REGULAR</td>
                                 <td>Gender: Male</td>
                              </tr>
                              <tr>
                                 <td>Result</td>
                                 <td>GPA=3.22</td>
                                 <td>Date of Birth</td>
                                 <td><?php echo $birthday; ?></td>
                              </tr>
                              <tr>
                                 <td>Name of Institute</td>
                                 <td colspan="3"><span id="i_name">PRIMARY SCHOOL MANAGEMENT SYSTEM (PSMS)</span></td>
                              </tr>
                           </tbody>
                        </table>
                              <div class="text-center"><h4>Subject-Wise Grade/Marks</h4></div>
                        <table class="table table-striped table-bordered" width="100%">
                           <thead class="bg-success">
                              <tr>
                                 <th class="text-white">Subject Code</th>
                                 <th class="text-white">Subject Name</th>
                                 <th class="text-white">Marks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $subList = json_decode($subjects,true);

                              $length = count($subList)/2.5;
                              for($a=1; $a<$length; $a++) :
                              ?>
                              <tr>
                                 <td class="cent-align"><?php echo getSubjectCode($subList['subject_id_'.$a]); ?></td>
                                 <td><span class="code_101"><?php echo $subList['subject_'.$a]; ?></span></td>
                                 <td class="cent-align"><?php echo $subList['subject_'.$a.'_marks']; ?></td>
                              </tr>
                              <?php endfor;?>
                              <!-- <tr>
                                 <td class="cent-align">107</td>
                                 <td><span class="code_107">ENGLISH</span></td>
                                 <td class="cent-align">C</td>
                              </tr>
                              <tr>
                                 <td class="cent-align">109</td>
                                 <td><span class="code_109">MATHEMATICS</span></td>
                                 <td class="cent-align">D</td>
                              </tr>
                              <tr>
                                 <td class="cent-align">111</td>
                                 <td><span class="code_111">ISLAM AND MORAL EDUCATION</span></td>
                                 <td class="cent-align">A-</td>
                              </tr> -->
                           </tbody>
                        </table>
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
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
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
   $('.printMe').click(function(){
      window.print();
   });
</script>