<?php
function getUserDetails($connection, int $userId)
{
    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row);
}
