<?php

session_start();

session_destroy();
header("location:result_form.php");