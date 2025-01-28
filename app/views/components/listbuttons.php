<?php include('userdata.php'); ?>
<td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Single User</a></td>
<td><a href="singleuserfa?id=<?php echo $row['id']; ?>" class="myButton">Fetch Assoc</a></td>
<td><a href="singleuserfawc/<?php echo $row['id']; ?>" class="myButton">Wild Card</a></td>
</tr>