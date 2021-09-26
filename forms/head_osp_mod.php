<?php
$row0 = mysqli_fetch_row($result0);
echo "<form action=\"index.php?page=head_osp&action=mod&id=1\" method=\"post\" />
      <table>
      <tr>
      <td>OSP: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_osp_msc\" value=\"" . $row0[1] . "\" /></td>
      </tr>
      <tr>
      <td>Rok założenia OSP: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_osp_rok\" value=\"" . $row0[2] . "\" /></td>
      </tr>
      </table>
                    <div style=\"margin-top: 1%;\">
                        <input class=\"form_button\" type=\"submit\" value=\"Zapisz\" />
                  </div>
      </form>";

 ?>
