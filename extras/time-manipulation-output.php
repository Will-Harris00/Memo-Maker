<?php
$d = $_POST['datetime'].date('Y-m-d H:i');
$due =  date('Y-m-d H:i', strtotime($_POST['datetime']));
$dateandtime =  date('Y-m-d H:i', strtotime(str_replace("/","-",$_POST['date']) . $_POST['time']));
echo $d;
echo '<br>';
echo $due;
echo '<br>';
echo $dateandtime;
$dd = date('Y-m-d H:i',(str_replace("-","/", strtotime($dateandtime))));
echo '<br>';
echo $dd;
echo '<br>';
echo '<br>';
echo '<br>';
$output = Date('Y-m-d\TH:i',strtotime($due));
echo $output;
?>
<html lang="en">
<head>
    <title>hello</title>
</head>
<body>
    <input type="datetime-local" name="name" id="name" value="<?=$output?>">
</body>
</html>

