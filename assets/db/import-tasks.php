<?php
session_start();
require "header.php";

$xml = new SimpleXMLElement($_SESSION['imports']);

echo "<form action='inc/add-imports.inc.php' method='post'>
          <table> 
              <tr>
                  <th></th>
                  <th>Tasks</th>
              </tr>";
foreach($xml->task as $task) {
    echo "    <tr>
                  <td><input type='checkbox' name='tasks[]' value='{$task->id}'></td>
                  <td>{$task->name}</td>
              </tr>";
}
echo "    </table>
          <input type='submit' name='import_tasks' id='import_tasks' value='Import'>
      </form>";

require "footer.php";
?>
