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
    // Use absolute path to prevent path resolution issues
    xhr.open('GET', '/ejnew-system/function/update_last_active.php', true);
    xhr.onerror = function() {
      // Stop trying if there's an error to prevent browser overload
      console.log('Failed to update last active, stopping interval');
      clearInterval(updateInterval);
    };
    xhr.send();
  }

  // Update last active timestamp every 5 minutes, but with error handling
  var updateInterval = setInterval(updateLastActive, 300000);
  
  // Stop updating when page is unloaded to prevent memory leaks
  window.addEventListener('beforeunload', function() {
    clearInterval(updateInterval);
  });
</script>
