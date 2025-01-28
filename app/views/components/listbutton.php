<?php
if (isset($row['id'])) {
    include("userdata.php");
} else { ?> <td colspan="3">Don't mess with Uri dogger.</td>
<?php }
?>

<td><a href="../list" class="myButton">List</a></td>
</tr>