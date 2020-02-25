<?php

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */

//include '../databaseConn/bs_conn.php';
//$table="student";
//$criteria=keyvalue("id","120");
//checked id availability
//checkavailid($table,$criteria);
//read("","");
//$result=chkresult();
//update eg:
/* $criteria=keyvalue("id","120");
  $update=array();
  $update[]=keyvalue("key1","va'lu'e1");
  $update[]=keyvalue("key2","va'lu'e2");
  $update[]=keyvalue("key3","va'lu'e3");
  $updatedata=join(",",$update);
  update($table,$updatedata,$criteria); */

//insert eg:
/* $table="";
  $key=array();
  $values=array();
  $key[]="stud_id1";
  $values[]=insertvalue("stud_value1");
  $key[]="stud_id2";
  $values[]=insertvalue("stud_value2");
  $key[]="stud_id3";
  $values[]=insertvalue("stud_value3");
  $key[]="stud_id4";
  $values[]=insertvalue("stud_value4");
  $key[]="stud_id5";
  $values[]=insertvalue("stud_value5");
  $keysdata=join(",",$key);
  $valuedata=join(",",$values);
  insert($table,$keysdata,$valuedata); */

function testing() {
    return "included";
}

function optionlist($id, $value) {
    return "<option value='" . $id . "'>" . $value . "</option>";
}

function checkavailid($table, $criteria="", $field="id") {
   
    $sql = "SELECT " . $criteria . " FROM " . $table;
    if ($criteria != "") {
        $sql.=" where " . $criteria."=".$field;
    }
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    if (isset($row['id']) && ($row['id'] != "")) {
        return $row['id'];
    } else {
        return "0";
    }
}

function show($data) {
    $rows = mysql_num_rows($data);
    if ($rows > 0) {
        $tr = "";
        while ($row = mysql_fetch_array($data)) {
            $td = "";
            $cols = (count($row) / 2);
            $tr.="<tr>";
            for ($i = 0; $i < $cols; $i++) {
                $td.="<td>" . $row[$i] . "</td>";
            }
            $tr.=$td . "</tr>";
        }
    }
    $table = "<table>";
    $table.=$tr;
    $table.="</table>";
    return $table;
}

function insert($table, $keys, $values) {
    $sql = "INSERT INTO " . $table . "(" . $keys . ") VALUES (" . $values . ")";
    $result = mysql_query($sql);
    return $result;
}

function insert_importexcel($table, $keys, $values) {
    $sql = "INSERT INTO " . $table . "(" . $keys . ") VALUES (" . $values . ")";
    $result = mysql_query($sql);
    $last_id = mysql_insert_id();
    return $last_id;
}

function insert2($table, $arr, $insert="") {
    for ($i = 0; $i < count($arr); $i++) {
        $keysdata.=$arr[$i][0] . ",";
        $valuedata.=$arr[$i][1] . ",";
    }
    if ($keysdata != "") {
        $keysdata = substr($keysdata, 0, -1);
        $valuedata = substr($valuedata, 0, -1);
    }
    $sql = "INSERT INTO " . $table . "(" . $keysdata . ") VALUES (" . $valuedata . ")";
    $result = mysql_query($sql);

    if ($result) {
        if ($insert == "") {
            return $result;
        } else {
            return mysql_insert_id();
        }
    } else {
        return false;
    }
}

function update($table, $updatedata, $criteria="") {
    //create sql string
    $sql = "UPDATE " . $table . " SET " . $updatedata;
    if ($criteria != "") {
        $sql.=" where " . $criteria;
    }

    //get the return value from server, true or false
    $result = mysql_query($sql);

    return $result;
}

function delete($table, $criteria="") {
    $sql = "DELETE FROM " . $table;
    if ($criteria != "") {
        $sql.=" where " . $criteria;
    }
    $result = mysql_query($sql);
    return $result;
}

function fieldvalue($fld, $val) {
    return array('field' => $fld, 'value' => $val);
}

function keyvalue($key, $value) {
    return $keyvalue = $key . "=" . tosql(mysql_real_escape_string($value));
}

function keyvalue_now($key) {
    return $keyvalue = $key . "=now()";
}

function getvalue($value) {
    return (isset($value)) ? $value : "";
}

function insertdate($value) {
    return date('Y-m-d', strtotime($value));
}

function insertnow() {
    return "now()";
}

function insertvalue($value) {
    return $value = tosql(mysql_real_escape_string($value));
}

function insertkeyvalue($key, $value) {
    return array($key, tosql($value));
}

function chkresult($result) {
    if (!$result) {
        $status = "rollback";
    } else {
        $status = "commit";
    }
    return $status;
}

function sqlresult($status) {
    if ($status != "rollback") {
        commit();
        return "success";
    } else {
        rollback();
        return "fail";
        exit();
    }
}

function begin() {
    mysql_query("BEGIN");
}

function commit() {
    mysql_query("COMMIT");
}

function rollback() {
    mysql_query("ROLLBACK");
}

function lock($table) {
    mysql_query("LOCK TABLES " . $table . " WRITE;");
}

function unlock() {
    mysql_query("UNLOCK TABLES;");
}

function tosql($value, $type="text") {
    if ($value == "") {
        return "''";
    } else {
        if ($type == "number") {
            return doubleval($value);
        } else {
            if (get_magic_quotes_gpc() == 0) {
                $value = str_replace("'", "''", $value);
                $value = str_replace("\\", "\\\\", $value);
            } else {
                $value = str_replace("\\'", "''", $value);
                $value = str_replace("\\\"", "\"", $value);
            }
            return "'" . $value . "'";
        }
    }
}

/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>