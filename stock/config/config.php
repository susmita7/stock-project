<?php
      define("HOSTNAME", "localhost") ; /*---------------to define constant use define method in php --------*/
      define("USERNAME", "root") ;
      define("PASSWORD", "") ;
      define("DBNAME", "inventory") ;


      $con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DBNAME);