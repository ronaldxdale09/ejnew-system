<?php
include "db.php";

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id']; // Get the user's ID from the session
    // Update the last active timestamp for this user
    mysqli_query($con, "UPDATE users SET last_active = NOW() WHERE id = '$userId'");
}
mysqli_close($con);
?>

<script>
  function updateLastActive() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_last_active.php', true);
    xhr.send();
  }

  // Update last active timestamp every 5 minutes
  setInterval(updateLastActive, 300000);
</script>
