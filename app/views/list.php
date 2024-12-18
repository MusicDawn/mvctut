<!-- //Here we will create a table, our syntex will look like this! -->
<a href="/" class="myButton">Home</a>
<table>
    <tr>
        <th>First Name</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Click to User</th>
    </tr>
    <?php
    //num_rows is a key from the assoc array $rows!
    if ($rows->num_rows > 1) {
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Single User</a></td>
            <?php }
    } else {
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="list" class="myButton">List</a></td>
        <?php }
    } ?>


            </tr>
</table>