<?php

if(isset($_POST["btnsubmit"])){

$date = $_POST["cyear"]."-".$_POST["cmonth"]    .$_POST["date"];

$query = "select *from  user" ;
$result = mysqli_query($conn, $query) or die("select error");

while($rec = mysqli_fetch_array($result)){

$mno = $rec["user_id"] ;

if(isset($_POST[$mno])){

$query1 = "INSERT INTO attendance ('user_id', 'date', 'attendance)

VALUES('$mno','$date','1')";
}else{

$query1 = "INSERT INTO attendance ('user_id', 'date',  attendance)

VALUES('$mno', '$date', '0')";
}

mysqli_query($conn, $query1) or die("insert error" $mno);

print "<script>";
}else{

print "alert('Attendance get successfully....').".

print "self.location='getattendance.php' ";

print "</script>";}

header("Location: printreport.php");}?>

<body>

<div class="container">

<h1><span class="style1">Add Attendance</span></h1>

<form action="getattendance1.php" method="post">

<table>

<tr>

<th>Select date: </th>

<td>

<?php

$dt = getdate();
$day = $dt["mday"];
$month= date("m");
$year = $dt["year"];

echo "<select name='cdate'>";

for($a=1;$a<=31;$a++) {

echo "<option value='$a'" . ($day==$a? " selected='selected'": "") . ">$a</option>";}

echo "</select>";

echo "<select name='cmonth'>";

for($a=1;$a<=12;$a++) {

echo "<option value='$a'"  . ($month == $a?" selected='selected"": """) . ">$a</option>";}

echo "</select>";

echo "<select name='cyear'>";

for($a=2010;$a<=$year;$a++)

{

echo "<option value='$a'"  . ($year == $a?" selected='selected" : ""). ">$a</option>";}

echo "</select>";?></td></tr></table><table><tr>

<th colspan="2"><span class="style2">Get Attendance</span></th>

</tr><tr>

<th><span class="style7">Name</span></th>

<th><span class="style7">Tick if Yes</span></th>

</tr>

<?php

$query = "SELECT * FROM `user` ORDER BY  user_id`";

$s=0;

$result = mysqli_query($conn, $query) or die("select error");

while($rec = mysqli_fetch_array($result)) {

$s++;

echo '<tr>

<td>'.$rec["username"].'</td>

<td><input type="checkbox" name=".$rec["user_id"]."

onclick="getatt(this.checked);" /></td>

<tr>

</tr>';}?>

<td colspan="2" align="center">

<input type="submit" value="Get Attendance" name="btnsubmit" class="btn-submit" />

<?php

if(isset($_POST["btn-print"])){header("Location: printreport.php");

}

?> </td></tr></table></form>

<div class="attendance-count">

<input type="text" id="txtAbsent" value="<?php print $s ?>" size="10" disabled="disabled" />
<label>- Total No</label>

<br>

<input type="text" id="txtPresent" value="0" size="10" disabled="disabled" />

<label>- Total Yes</label>

<br>

<input type="text" id="txtStrength" value="<?php print $s; ?>" size="10" disabled="disabled" />
<label>- Total</label>

</div>

<div style="clear:both;"></div>

</div>

<script>

function getatt(value) {

if (value) {

document.getElementById("txtAbsent").value =
parseInt(document.getElementById("txtAbsent").value) - 1;
document.getElementById("txtPresent").value =
parseInt(document.getElementById("txtPresent").value) + 1;
} else {

document.getElementById("txtAbsent").value =
parseInt(document.getElementById("txtAbsent").value) + 1;
parseInt(document.getElementById("txtPresent").value) - 1;}}
document.getElementById("txtPresent").value =
</script></body>