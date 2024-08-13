<?php
session_start();
include_once 'config.php';
$outgoing_id = $_SESSION['unique_id'];
//GETTING DAT FROM DB
$sql = "SELECT * FROM users WHERE NOT unique_id = {$_SESSION['unique_id']} ORDER BY id";
$query = mysqli_query($conn, $sql);
//SETTINg OUTPUT VARIABLE FOR ALL THE USER DATA
$output = "";
//GETTING USERS
if (mysqli_num_rows($query) === 0) {
  $output .= "No user is available for chat";
} elseif (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages 
    WHERE 
    (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
    AND 
    (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
    ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
      $result = $row2["msg"];
    } else {
      $result = "No message Available";
    }
    //
    (strlen($result) > 26) ? $msg = substr($result, 0, 26) . '...' : $msg = $result;
    //
    //($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    //
    ($row['status'] == "offline") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '" class="flex">
        <div class="content flex items-center">
            <img src="' . $row['img'] . '" alt="" />
            <div class="details">
                <span>' . $row['firstName'] . " " . $row['lastName'] . '</span>
                <p>' . $msg . '</p>
            </div>
        </div>
        <div class="status-dot ' . $offline . ' flex items-center">*</div>
    </a>';
  }
}
echo $output;