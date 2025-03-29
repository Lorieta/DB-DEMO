<?php
require 'config.php';
require 'query.php';


$query = new Query($conn);
//SELECT all user
$allUsers = $query->select();
echo "All Users" . "</br>";
echo "<table border='1'>";
//header
echo "<tr>
        <th>Name</th>
        <th>Email</th>
        <th>Age</th>
      </tr>";

while ($user = $allUsers->fetch(PDO::FETCH_ASSOC)) {
    //body
    echo "<tr>";
    echo "<td>" . $user['name'] . "</td>";
    echo "<td>" . $user['email'] . "</td>";
    echo "<td>" . $user['age'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// SELECT single user by email
$email = 'john.doe@example.com';
$singleUser = $query->selectByEmail($email);

if ($singleUser) {
    echo "Single User Found:<br>" . $email;
    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>" . $singleUser['name'] . "</td>";
    echo "<td>" . $singleUser['email'] . "</td>";
    echo "<td>" . $singleUser['age'] . "</td>";
    echo "</tr>";
} else {
    echo "User not found.";
}
?>