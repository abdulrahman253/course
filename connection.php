<?php

   $hostName='database-1.cov72iohk5ci.us-east-1.rds.amazonaws.com';
   $userName='admin';
   $userPass='123456789';
   $dbName='test';

   $con=mysqli_connect($hostName,$userName,$userPass,$dbName);

   /*if(!$con){

   	echo "connection failed";
   }
   else
   	echo "connection succes";*/

?>