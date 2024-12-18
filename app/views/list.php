<!-- //Here we will create a table, our syntex will look like this! -->
 <a href="/" class="myButton" >Home</a>
<table>
    <tr>
        <th>First Name</th>
        <th>First Name</th>
        <th>email</th>
    </tr>
    <?php
    foreach ($rows as $row) { ?>
    <tr>
        <td><?php echo $row['first_name']; ?></td>
        <td><?php echo $row['last_name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        
        <?php } ?>
    </tr>
</table>