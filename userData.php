<?php
function getUserDetails($connection, int $userId)
{
    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row);
}

function getCompanyDetails($connection, int $companyId)
{
    $query = "SELECT * FROM business WHERE company_id = $companyId";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return ($row);
}