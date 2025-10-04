<?php
require "app/app.php";

Session::destroy();
header("location:login.php");