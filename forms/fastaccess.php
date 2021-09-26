<?php

echo "<form action=\"index.php?page=fastaccess\" method=\"post\">
        <table>
            <tr>
                <td>Adres odnośnika: </td>
                <td><input class=\"form_inputs\" type=\"text\" name=\"fastaccess_link\" /></td>
            </tr>
            <tr>
                <td>Nazwa odnośnika: </td>
                <td><input class=\"form_inputs\" type=\"text\" name=\"fastaccess_nazwa\" /></td>
            </tr>
        </table>
        <div>
            <input class=\"form_button\" type=\"submit\" value=\"Zapisz\" />
            <button class=\"clear\">Wyczyść</button>
        </div>
        </form>";


?>