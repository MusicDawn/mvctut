<?php
$con = new mysqli('localhost', 'panos', '', 'mvctut');

// The porpuse of this file is to have the list that we have aleady created in a seperate file so when we delete it, we can bring it back from the terminal -->
// Terminal code : 1) Open a terminal in the location of this file and type php migration.php, && by that we have our list back to out table plus.
$query = "CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
(1, 'Panos', 'Mod', 'gamiseta@yahoo.gr');
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
(2, 'Myrtw', 'SoyGirl', 'hihihihhi@yahoo.gr');
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
(3, 'Lege', 'Pes', 'legepes@yahoo,gr');
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`) VALUES
(4, 'Panagiotis', 'Kostakis', 'raidsowns@gmail.com'),
(6, 'safasf', 'afdasf', 'asfasf@ajgbasogb.org');";

// In order this to work we have to use the METHOD multy_query($....) to our $con so we instead of $con->query($query); we have -->
$con->multi_query($query);