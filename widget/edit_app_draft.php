
<?php

$m = $_POST['m'];
$c_id = $_POST['c_id'];

$sql = 'UPDATE appraisal_draft SET appraisee_comment="'.$m .'" WHERE id='.$c_id;
$query = mysql_query($sql);
if ($query) {

    print true;
} else {
    print false;
}
?>
