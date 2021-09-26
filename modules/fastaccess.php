<?php

function theTables($connection) {

    $tName = 'fastaccess';
    $csh = 'id,nazwa,link';
    $whereValue = 'true';

    $result = prepareForm($connection, $tName, $csh, $whereValue);

    if ( mysqli_num_rows($result) > 0 ) {

        echo "<table class=\"moduleTable\">
                <tr class=\"nonParityTableRow\">
                    <th class=\"tableHeaderCell\">Nazwa</th>
                    <th class=\"tableHeaderCell\">Odnośnik</th>
                    <th class=\"tableHeaderCell\">Akcja</th>";

        $rcount = 2;


        while ( $row = mysqli_fetch_row($result) ) {

            if ( $rcount % 2 === 0 ) {
                echo "<tr class=\"parityTableRow\">";
            } else {
                echo "<tr class=\"nonParityTableRow\">";
            }

            echo "<td class=\"tableDataCell\">" . $row[1] . "</td>
                 <td class=\"tableDataCell\">" . $row[2] . "</td>
                 <td class=\"tableDataCell\"><a href=\"index.php?page=fastaccess&action=del&id=" . $row[0] . "\">
                 <button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a>
                 </td>";

            echo "</tr>";

            $rcount++;
        }

    } else {
        echo "<h3>Brak danych do wyświetlenia";
    }
}


if ( count($_POST) > 0 ) {

    $tName = 'fastaccess';
    $csh = 'nazwa,link';
    $pKL = generatePKL($tName, $csh);

    dbAdd($connection, $tName, $csh, $pKL);
    theTables($connection);

} else {

    if ( isset($_GET['action']) && ( $_GET['action'] === 'del') ) {

        $del_id = $_GET['id'];
        $tName = 'fastaccess';
        $whereValue = 'id=' . $del_id;

        dbDel($connection, $tName, $whereValue);
        theTables($connection);
        

    } else {

        echo "<div id=\"form=\">";
        include('forms/fastaccess.php');
        echo "</div>
            <hr id=\"theline\">
        <div id=\"result\">";
            theTables($connection);
     echo "</div>";

    }


    
}


?>