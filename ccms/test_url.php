<?
$last_line = system('ifconfig eth1', $retval);
echo 'Last line of the output: ' . $last_line;
echo '<hr />Return value: ' . $retval;