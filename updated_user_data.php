<?php
function getUserDetails($connection, int $userId)
{
    $query = "SELECT user_id, FirstName, LastName, company, skills FROM users WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row);
}
