<?


// This will not work as expected on Linux.
ob_implicit_flush ();
for($i=0;$i<10;$i++) {
   echo "grrrrrrrrrr\n";
   @ob_flush();
   sleep(1);
}

?>
