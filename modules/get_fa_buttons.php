<?php

//echo "<a href=\"index.php?page=fastaccess\"><button id=\"fastaccess_cfg\" style=\"border-color: rgb(216, 216, 216); border-radius: 5px;\"><img src=\"resources/gear.png\" style=\"margin-top: 2px; width: 20px;\" /></button></a>";
echo "<a href=\"index.php?page=fastaccess\"><div style=\"display: inline-block; background-color: #fcfcfc; padding-top: 5.5px; padding-bottom: 3.5px; padding-left: 5px; padding-right: 5px;\" id=\"fastaccess_cfg\"><img src=\"resources/gear.png\" style=\"width: 20px;\" /></div></a>";

$tName = 'fastaccess';
$csh = 'nazwa,link';
$whereValue = 'true';

$result = prepareForm($connection, $tName, $csh, $whereValue);

if ( mysqli_num_rows($result) > 0 ) {

    while( $row = mysqli_fetch_row($result) ) {
        //echo "<a href=\"" . $row[1] . "\" style=\"margin-left: 5px; vertical-align: bottom;\"><button>" . $row[0] . "</button></a>";
        echo "<a href=\"" . $row[1] . "\" style=\"margin-left: 5px; vertical-align: bottom;\"><div class=\"fa_button\">" . $row[0] . "</div></a>";
    }

}

?>