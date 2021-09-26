<?php

	//include('db_conf.php');
        session_start();

	if (isset($_SESSION['username'])) {
	
		include('db_conf.php');

          //include('fastaccess.php');
          //include('menu.php');
          //echo "<div id=\"content\">";

          include('library.php');
          

				  if ( isset($_GET['page']) ) {
					 if ( is_file("modules/" . $_GET['page'] . ".php") ) {
            writeLogs($connection, 'Odwiedzono moduł: ' . $_GET['page'], $_SESSION['username']);
						  include("modules/" . $_GET['page'] . ".php");
           }
          }

				  //echo "</div>";

      } else {
        echo "<script>window.location.assign('login.php');</script>";
      }

?>
