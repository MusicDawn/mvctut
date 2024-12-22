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
    // PHP_URL_PATH tells parse_url() to return only the path component of the URL.
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri == "/list") {
        print_r($rows);
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Single User</a></td>
                <td><a href="singleuserfa?id=<?php echo $row['id']; ?>" class="myButton">Fetch Assoc</a></td>
            <?php }
    } else if ($uri == "/listfa") {
        print_r($result);
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="singleuser?id=<?php echo $row['id']; ?>" class="myButton">Single User</a></td>
                <td><a href="singleuserfa?id=<?php echo $row['id']; ?>" class="myButton">Fetch Assoc</a></td>
            <?php }
    } else if ($uri == "/singleuser") {
        print_r($rows);
        foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="list" class="myButton">List</a></td>
            <?php }
    } else if ($uri == "/singleuserfa") {
        echo "<br>";
        print_r($row);
        echo "<br>";
        print_r($result);
            ?>
            <tr>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><a href="list" class="myButton">List</a></td>?>

            <?php } ?>


            </tr>
</table>