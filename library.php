<?php

function mysqliResult($connection, $result) {

  if ( $result ) {
    //echo "<script>console.log('Zapytanie powidło się');</script>";
    return true;
  } else {
    echo "<script>console.log('Zapytanie nie powiodło się: " . mysqli_error($connection) . "');</script>";
    return false;
  }

}

function writeLogs($connection, $msg, $user = 'null' ) {
  $datetime = date('d-m-Y H:i:s');
  //--[DATA]--[USER/SYSTEM]: $msg --
  $query = sprintf("INSERT INTO logs (user, event, eventdt)
                    VALUES ('%s', '%s', '%s')",
                    mysqli_real_escape_string($connection, $user),
                    mysqli_real_escape_string($connection, $msg),
                    mysqli_real_escape_string($connection, $datetime));
  $result = mysqli_query($connection, $query);
  if ( ! mysqliResult($connection, $result) ) {
    echo "<script>console.log('Zapisanie zdarzeń do dziennika jest nie możliwe');</script>";
  }
}


function ifIAmInteger ($variable) {
  if ( preg_match('/[^a-ząęśćźżńółA-ZĄĘŚĆŹŻŃÓŁ ]/', $variable)
        && ( ! preg_match('/-/', $variable) )
        && ( ! preg_match('/[\\\]/', $variable) )
        && ( ! preg_match('/\//', $variable) )
        && ( ! preg_match('/\!/', $variable) )
        && ( ! preg_match('/\,/', $variable) )
        && ( ! preg_match('/\./', $variable) )
        && ( ! preg_match('/\_/', $variable) )
        && ( ! preg_match('/\:/', $variable) )
				&& ( ! preg_match('/[a-zA-Z]/', $variable) )
			) {
    $backupVariable = $variable;
    $variable = intval($backupVariable);
    return $variable;
  } else {
    return $variable;
  }

}

function dbAdd($connection, $tableName, $columScheme, $postKeyList, $mode = 'std') {

    $query = "INSERT INTO " . $tableName . " (" . $columScheme . ") VALUES (";

    $postKeyListTab = explode(',', $postKeyList);

    for ( $i=0; $i < count($postKeyListTab); $i++) {

      $postKey = $postKeyListTab[$i];

      $_POST[$postKey] = ifIAmInteger($_POST[$postKey]);

      if ( (stripos($postKey, 'data') !== FALSE ) ||
           (stripos($postKey, 'e_about_alarm') !== FALSE ) ||
           (stripos($postKey, 'termin') !== FALSE ) ||
            (stripos($postKey, 'rozpoczecie') !== FALSE ) ||
            (stripos($postKey, 'zakonczenie') !== FALSE ) ) {
                 if ( strlen($_POST[$postKey]) > 0 ) {
                      $ts = strtotime($_POST[$postKey]);
                      $dtData = date("Y-m-d H:i:s", $ts);
                      $_POST[$postKey] = $dtData;
                } else {
                  $dtData = date("Y-m-d H:i:s", 0);
                  $_POST[$postKey] = $dtData;
                }
                $msg = 'Konwersja daty z ' . $_POST[$postKey] . ' na ' . $dtData;
           }

      if ( (count($postKeyListTab) - 1) === $i ) {
        if ( (gettype($_POST[$postKey]) === 'integer') || (gettype($_POST[$postKey]) === 'double') ) {
          $query .= $_POST[$postKey] . ");";
        } else {
          $query .= "'" . mysqli_real_escape_string($connection, $_POST[$postKey]) . "');";
        }
      } else {

        if ( (gettype($_POST[$postKey]) === 'integer') || (gettype($_POST[$postKey]) === 'double') ) {
          $query .= $_POST[$postKey] . ", ";
        } else {
          $query .= "'" . mysqli_real_escape_string($connection, $_POST[$postKey]) . "', ";
        }
      }

    }


    if ( $mode === 'dryrun' ) {
	echo $query . "<br />";
    } else {

	   	 $result = mysqli_query($connection, $query);

	    	if ( isset($msg) ) {
        		$msg .= '<br />Wydano zapytanie: ' . $query;
	    	} else {
        		$msg = '<br />Wydano zapytanie: ' . $query;
    		}

    		writeLogs($connection, $msg, $_SESSION['username']);
 	 	if ( ! mysqliResult($connection, $result) ) {
			//var_dump($query);
			echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";
		    echo "<script>console.log('Dodanie danych do bazy jest nie możliwe');</script>";
		    exit;
		}
	}

}

function dbMod($connection, $tableName, $columScheme, $postKeyList, $whereValue, $mode = 'std') {

    $query = "UPDATE " . $tableName . " SET ";

    $columSchemeTab = explode(",", $columScheme);
    $postKeyListTab = explode(',', $postKeyList);

    for ($i=0; $i < count($postKeyListTab); $i++) {
      $postKey = $postKeyListTab[$i];

      $_POST[$postKey] = ifIAmInteger($_POST[$postKey]);

      if ( (stripos($postKey, 'data') !== FALSE ) ||
           (stripos($postKey, 'alarm') !== FALSE ) ||
           (stripos($postKey, 'termin') !== FALSE ) ||
            (stripos($postKey, 'rozpoczecie') !== FALSE ) ||
            (stripos($postKey, 'zakonczenie') !== FALSE ) ) {
                 if ( strlen($_POST[$postKey]) > 0 ) {
                      $ts = strtotime($_POST[$postKey]);
                      $dtData = date("Y-m-d H:i:s", $ts);
                      $_POST[$postKey] = $dtData;
                } else {
                  $dtData = date("Y-m-d H:i:s", 0);
                  $_POST[$postKey] = $dtData;
                }
              $msg = 'Konwersja daty z ' . $_POST[$postKey] . ' na ' . $dtData;
           }

      if ( (count($postKeyListTab) - 1) === $i ) {
        if ( (gettype($_POST[$postKey]) === 'integer') || (gettype($_POST[$postKey]) === 'double') ) {
          $query .= $columSchemeTab[$i] . '=' . $_POST[$postKey];
        } else {
          $query .=  $columSchemeTab[$i] . "='" . mysqli_real_escape_string($connection, $_POST[$postKey]) . "'";
        }
      } else {

        if ( (gettype($_POST[$postKey]) === 'integer') || (gettype($_POST[$postKey]) === 'double') ) {
          $query .= $columSchemeTab[$i] . '=' . $_POST[$postKey] . ", ";
        } else {
          $query .= $columSchemeTab[$i] . "='" . mysqli_real_escape_string($connection, $_POST[$postKey]) . "', ";
        }
      }

    }

    $query .= " WHERE " . $whereValue . ";";

	if ( $mode === 'dryrun' ) {
		
		echo $query . "<br />";

	} else {

 		   $result = mysqli_query($connection, $query);

		    if ( isset($msg) ) {
			      $msg .= 'Wydano zapytanie: ' . $query;
		    } else {
			      $msg = 'Wydano zapytanie: ' . $query;
    		    }

	   	    if ( ! mysqliResult($connection, $result) ) {
			    //var_dump($query);
		    	    echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

     	 			echo "<script>console.log('Modyfikacja danych w bazie jest nie możliwe');</script>";
     	 			exit;
			 }
	}		   
}

function dbDel($connection, $tableName, $whereValue, $mode = 'std') {

	$query = "DELETE FROM " . $tableName . " WHERE " . $whereValue . ";";
	if ( $mode === 'dryrun' ) {
		echo $query . "<br />";
	 } else {
     		 $result = mysqli_query($connection, $query);
		 writeLogs($connection, 'Wydano zapytanie: ' . $query, $_SESSION['username']);

	  	    if ( ! mysqliResult($connection, $result) ) {
			     echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";
  
		        echo "<script>console.log('Usuniecie danych z bazy jest nie możliwe');</script>";
		        exit;
      			}
	}

}

function tables($connection, $tableName, $tableHeaders, $columScheme, $query = 'STD') {

      if ( $query === 'STD' ) {
          $query = "SELECT " . $columScheme . " FROM " . $tableName . ";";
      }
      $result = mysqli_query($connection, $query);
      $logsMsg = 'Wydano zapytanie: ' . $query;
      //writeLogs($connection, 'Wydano zapytanie: ' . $query, $_SESSION['username']);
      if ( ! mysqliResult($connection, $result) ) {
	      //var_dump($query);
	      
	      echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

        echo "<script>console.log('Pobranie danych z bazy jest nie możliwe');</script>";
        exit;
      } else {
        if ( mysqli_num_rows($result) > 0 ) {
        echo "<table style=\"width: 100%; border-spacing: 0;\">";
        echo "<tr style=\"background-color: #ADBDCE;\">";
        $tableHeadersTab = explode(",", $tableHeaders);
        for ($i=0; $i < count($tableHeadersTab); $i++) {
              echo "<th style=\"padding: 1%;\">" . $tableHeadersTab[$i] . "</th>";
        }
        echo "<th colspan=\"2\" style=\"padding: 1%;\">Akcja</th>";
	echo "</tr>";
	$rcount = 0;
	while ($row = mysqli_fetch_row($result)) {
		if ( $rcount % 2 === 0 ) {
            		echo "<tr style=\"background-color: #748EA8; text-align: center;\">";
		} else {
			echo "<tr style=\"background-color: #ADBDCE; text-align: center;\">";
		}
            for ( $i=1; $i < count($tableHeadersTab)+1; $i++ ){
                  //echo "LABEL: " . $tableHeadersTab[$i];
                  if ( (stripos($tableHeadersTab[($i - 1)], 'data') !== FALSE ) ||
                       (stripos($tableHeadersTab[($i - 1)], 'alarm') !== FALSE ) ||
                       (stripos($tableHeadersTab[($i - 1)], 'termin') !== FALSE ) ||
                        (stripos($tableHeadersTab[($i - 1)], 'rozp') !== FALSE ) ||
                        (stripos($tableHeadersTab[($i - 1)], 'zako') !== FALSE ) ) {
                            //echo "LABEL2: " . $tableHeadersTab[$i];
                             if ( $row[$i] !== '1970-01-01 00:00:00' ) {
                                  $ts = strtotime($row[$i]);
                                  if ( stripos($tableHeadersTab[($i - 1)], 'data') !== FALSE ) {
                                      $dtData = date("d.m.Y", $ts);
                                  } else {
                                      $dtData = date("d.m.Y H:i", $ts);
                                  }
                                  //writeLogs($connection, 'Konwersja daty z ' . $row[$i] . ' na ' . $dtData, $_SESSION['username']);
                                  $logsMsg .= '<br />Konwersja daty z ' . $row[$i] . ' na ' . $dtData;
                                  $row[$i] = $dtData;
                            } else {
                              $row[$i] = "N/D";
                            }
                  }

                echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[$i] . "</td>";
            }
            echo "<td style=\"border-left; 1px solid lightgray; border-right: 1px solid lightgray;\">
          <a href=\"index.php?page=" . $_GET['page'] . "&action=mod&id=" . $row[0] ."\">
            <button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a>
            </td>";
            echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">
          <a href=\"index.php?page=" . $_GET['page'] . "&action=del&id=" . $row[0] ."\">
            <button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a>
            </td>";
			      echo "</tr>";
			      $rcount++;
           }
           echo "</table>";
        } else {
          echo "<h2>Brak danych do wyświetlenia</h2>";
        }

      }
      $logsMsg .= '<br /> Wygenerowano tabele.';
      writeLogs($connection, $logsMsg, $_SESSION['username']);
}

function prepareForm($connection, $tableName, $columScheme, $whereValue) {
  $query = "SELECT " . $columScheme . " FROM " . $tableName . " WHERE " . $whereValue;
  $result = mysqli_query($connection, $query);
  writeLogs($connection, 'Wydano zapytanie: ' . $query, $_SESSION['username']);
  if ( mysqliResult($connection, $result) ) {
    return $result;
  } else {
	  //var_dump($query);
	  echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

    echo "<script>console.log('Pobranie danych z bazy jest nie możliwe');</script>";
    exit;
  }
}

function preparePOTOForm($connection, $p0, $t0, $tableName, $whereValue, $t0cols, $formPath, $columScheme) {
  //$p0 - numer z personal_id;
    $query1 = "SELECT " . $columScheme . " FROM " . $tableName . " WHERE " . $whereValue;
    $result1 = mysqli_query($connection, $query1);
    writeLogs($connection, 'Wydano zapytanie: ' . $query1, $_SESSION['username']);
    if ( mysqliResult($connection, $result1) ) {
      $query2 = "SELECT " . $t0cols . " FROM " . $t0;
      $result2 = mysqli_query($connection, $query2);
      writeLogs($connection, 'Wydano zapytanie: ' . $query2, $_SESSION['username']);
      if ( mysqliResult($connection, $result2) ) {
        include($formPath);
      } else {
	      //var_dump($query2);
	      echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

        echo "<script>console.log('Pobranie danych z bazy jest nie możliwe');</script>";
        exit;
      }
    } else {
	    //var_dump($query1);
	    echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

      echo "<script>console.log('Pobranie danych z bazy jest nie możliwe');</script>";
      exit;
    }


}

function potoTables($connection, $p0, $t0, $tableName, $tableHeaders, $t0cols) {

    $query1 = "SELECT * FROM " . $tableName;
    $result1 = mysqli_query($connection, $query1);
    $logsMsg = 'Wydano zapytanie: ' . $query1;
    //writeLogs($connection, 'Wydano zapytanie: ' . $query1, $_SESSION['username']);
      if ( mysqliResult($connection, $result1) )  {
        if ( mysqli_num_rows($result1) > 0 ) {
          echo "<table style=\"width: 100%; border-spacing: 0;\">";
          echo "<tr style=\"background-color: #ADBDCE; text-align: center; padding: 1%;\">";
          $tableHeadersTab = explode(",", $tableHeaders);
          for ( $i=0; $i < count($tableHeadersTab); $i++) {
            echo "<th>" . $tableHeadersTab[$i] . "</th>";
          }
          echo "<th colspan=\"2\" style=\"padding: 1%;\">Akcja</th>";
	  echo "</tr>";
	  $rcount = 0;
          while ($row = mysqli_fetch_row($result1)) {
             $query2 = "SELECT " . $t0cols . " FROM " . $t0 . " WHERE id=" . $row[$p0];
             $result2 = mysqli_query($connection, $query2);
            $logsMsg = '<br />Wydano zapytanie: ' . $query2;
            //writeLogs($connection, 'Wydano zapytanie: ' . $query2, $_SESSION['username']);
             if ( mysqliResult($connection, $result2) ) {
		$row2 = mysqli_fetch_row($result2);

		if ( $rcount%2 === 0 ) {
			echo "<tr style=\"background-color: #748EA8; text-align: center;\">";
		} else {
			echo "<tr style=\"background-color: #ADBDCE; text-align: center;\">";
		}

               echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" .  $row2[0] . " " . $row2[1] . "</td>";
             }

            for ( $i=1; $i < count($row); $i++ ) {
              if ( $i === $p0 ) { continue; }
              else {
                    //echo "LABEL: " . $tableHeadersTab[$i];
                    if ( (stripos($tableHeadersTab[$i], 'data') !== FALSE ) ||
                          (stripos($tableHeadersTab[$i], 'alarm') !== FALSE ) ||
                          (stripos($tableHeadersTab[$i], 'termin') !== FALSE ) ||
                          (stripos($tableHeadersTab[$i], 'rozpocze') !== FALSE ) ||
                          (stripos($tableHeadersTab[$i], 'zakoncze') !== FALSE ) ) {
                          //echo "LABEL2: " . $tableHeadersTab[$i];
                          if ( $row[$i] !== '1970-01-01 00:00:00' ) {
                              $ts = strtotime($row[$i]);
                              if ( stripos($tableHeadersTab[$i], 'data') !== FALSE ) {
                                  $dtData = date("d.m.Y", $ts);
                              } else {
                                  $dtData = date("d.m.Y H:i", $ts);
                              }
                              $logsMsg .= '<br />Konwersja daty z ' . $row[$i] . ' na ' . $dtData;
                              //writeLogs($connection, 'Konwersja daty z ' . $row[$i] . ' na ' . $dtData, $_SESSION['username']);
                              $row[$i] = $dtData;
                          } else {
                            $row[$i] = "N/D";
                          }
                      }

                echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[$i] . "</td>";
              }
            }
            echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">
            <a href=\"index.php?page=" . $_GET['page'] . "&action=mod&id=" . $row[0] . "\">
            <button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button>
            </a></td>";
            echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">
            <a href=\"index.php?page=" . $_GET['page'] . "&action=del&id=" . $row[0] . "\">
            <button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
            </a></td>";
		echo "</tr>";
		$rcount++;
          }
          echo "</table>";
        } else {
          echo "<h2>Brak danych do wyświetlenia</h2>";
        }
      } else {
	      //var_dump($query1);
	      echo "<div id=\"wrgpass\"><h3>Operacja nie powiodła się.<br />Upewnij się że masz dostęp do bazy danych  oraz czy wszystkie dane zostały poprawnie wpisane</h3></div>";

        echo "<script>console.log('Pobranie danych z bazy jest nie możliwe');</script>";
        exit;
      }
    $logsMsg .= '<br />Wygenerowano tabele z punktem odniesienia';
    writeLogs($connection, $logsMsg, $_SESSION['username']);
}

function generateSelectOptionList($defaultOption, $list) {
  echo "$defaultOption</option>";

  if ( key($list) === 0 ) {
      foreach ($list as &$listElement) {

        if ( $listElement === $defaultOption ) { continue; }
        else {
          echo "<option value=\"" . $listElement . "\">" . $listElement . "</option>";
        }

      }

    }
      else {
        foreach ($list as &$listElement) {

          if ( $listElement === $defaultOption ) { next($list); continue; }
          else {
            echo "<option value=\"" . key($list) . "\">" . $listElement . "</option>";
          }
          next($list);
        }
      }
  }

function generatePKL($tableName, $columScheme) {

    $columSchemeTab = explode(',', $columScheme);

    for ($i=0; $i < count($columSchemeTab); $i++) {

      if ( (count($columSchemeTab) - 1) === $i ) {

        if ( $i === 0 ) {
          $pKL = $tableName . "_" . $columSchemeTab[$i];
        } else {
          $pKL .= $tableName . "_" . $columSchemeTab[$i];
        }

      } else {

        if ( $i === 0 ) {
          $pKL = $tableName . "_" . $columSchemeTab[$i] . ",";
        } else {
          $pKL .= $tableName . "_" . $columSchemeTab[$i] . ",";
        }

      }

    }
    return $pKL;
}

function getLastIdOnTable($connection, $tableName) {
	$query = "SELECT id FROM " . $tableName . " ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($connection, $query);
	if ( mysqliResult($connection, $result) ) {
		return $result;
	}
}

function generateChboxTable($name, $list, $labels, $cols) {

  for($i=0; $i < count($list); $i++) {
    if ($i===0) { echo "<tr>"; }

    if ( isset($_POST[$name][$i]) && ( strlen($_POST[$name][$i]) > 0 ) ) {
      echo "<td><input type=\"checkbox\" name=\"" . $name . "[" . $i . "]\" value=\"" . $_POST[$name][$i] . "\" checked />" . $labels[$i] . "</td>";
    }
    else {
      echo "<td><input type=\"checkbox\" name=\"" . $name . "[" . $i . "]\" value=\"" . $list[$i] . "\" />" . $labels[$i] . "</td>";
    }
    if ( $cols !== 0 ) {
      if ( ($i%$cols===0) && ( $i > 0 ) ) { echo "</tr><tr>"; }
    }
    if ( $i===(count($list) - 1) ) { echo "</tr>"; }
  }

}


function tabSerialize ($tab, $tabLength) {
  $j=0;
  $serial = array();
  for($i=0; $i<=$tabLength; $i++) {
    if (isset($tab[$i])){
      $serial[$j]=$tab[$i];
      $j++;
    }
  }
  return $serial;
}

function returnWhereValues ($connection, $tab, $col) {
  $value='(';
  if ( count($tab) > 1 ) {
    for($i=0; $i < count($tab); $i++) {
      if ( $i === (count($tab) - 1) ) {
        $value .= $col . '=\'' . mysqli_real_escape_string($connection, $tab[$i]) . '\')';
      } else {
        $value .= $col . '=\'' . mysqli_real_escape_string($connection, $tab[$i]) . '\' OR ';
      }
    }
  } else {
    $value = $col . '=\'' . mysqli_real_escape_string($connection, $tab[0]) . '\'';
  }
  return $value;
}
/*
function unnecessaryDelete ($option1, $option2, $value1, $value2) {

  if ( isset($value1) && ( strlen($value1) > 0  ) ) {
    echo $option1 . " / <s>" . $option2 . "</s>";
  } else if ( isset($value2) && ( strlen($value2) > 0 ) ) {
    echo "<s>" . $option1 . "</s> / " . $option2;
  } else {
    echo $option1 . " / " . $option2;
  }
  echo "<sup>*)</sup>";

}
*/
function convertData($dataToConvert, $type = 'dt') {
  $ts = strtotime($dataToConvert);
  if ( $type === 'y' ) {
    $dtData = date("Y-m-d", $ts);
  } else if ( $type === 'd' ) {
    $dtData = date("d.m.Y", $ts);
  } else {
    $dtData = date("d.m.Y H:i", $ts);
  }
  return $dtData;
}

function randomQuery($connection, $query) {
	$result = mysqli_query($connection, $query);
	//var_dump($result);
		if ( mysqli_num_rows($result) > 0 ) {
			$row = mysqli_fetch_row($result);
			return $row[0];
		} else {
			return 0;
		}
}

function dictionary($word) {

	$fp = fopen('dictionary.html', 'w');

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://nlp.actaforte.pl:8080/Nomina/Miejscowosci?nazwa=' . urlencode($word));
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_exec($ch);
	curl_close($ch);

	fclose($fp);

	$f = file('dictionary.html');

	$fTab = explode('>', $f[0]);
	$i = 0;

	foreach ( $fTab as $fLine ) {
	
		if ( stripos($fLine, 'Miejscownik') !== FALSE ) {
++$i; break; }
		else { $i++; }
	
	}

	//echo $i . "<br />";
	$i = $i + 3;

	$fTabI = explode('<', $fTab[$i]);
	$urodzony = $fTabI[0];

	unlink('dictionary.html');

	return $urodzony;

}
?>
