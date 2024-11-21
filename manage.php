<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="styles/normalize.css" />
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <main class="main-content">
      <div class="manage-title">
        <h1>Manage Expressions of Interest (EOIs)</h1>
        <p>Use the options below to manage and query EOIs in the system.</p>
      </div>
      <div class="form-container">
    <!-- First Row -->
    <div class="action-row row1">
        <div class="action-column item1">
            <form method="post">
                <input type="hidden" name="action" value="list_by_job" />
                <label for="jobRef">Job Reference:</label>
                <input type="text" id="jobRef" name="jobRef" required />
                <button type="submit">List EOIs by Job Ref</button>
            </form>
        </div>

        <div class="action-column item1">
            <form method="post">
                <input type="hidden" name="action" value="list_by_applicant" />
                <div class="split-input">
                <div class="labelInput">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" />
                </div>
                <div class="labelInput">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" />
                </div>
                </div>
                <button type="submit">List EOIs by Applicant</button>
            </form>
        </div>

        <div class="action-column item1">
        <form method="post">
            <input type="hidden" name="action" value="list_all" />
            <div>List All EOIs</div>
            <button type="submit">List All EOIs</button>
        </form>
        </div>
    </div>

    <!-- Second Row -->
    <div class="action-row row1">
        <div class="action-column item2">
        <form method="post">
            <input type="hidden" name="action" value="delete_by_job" />
            <label for="deleteJobRef">Job Reference:</label>
            <input type="text" id="deleteJobRef" name="jobRef" required />
            <button type="submit">Delete EOIs by Job Ref</button>
        </form>
        </div>

        <div class="action-column item2">
        <form method="post">
            <input type="hidden" name="action" value="update_status" />
            <div class="split-input">
            <div class="labelInput">
                <label for="eoiNumber">EOI Number:</label>
                <input type="number" id="eoiNumber" name="eoiNumber" required />
            </div>
            <div class="labelInput">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="New">New</option>
                    <option value="Current">Current</option>
                    <option value="Final">Final</option>
                </select>
            </div>
            </div>
            <button type="submit">Update Status</button>
        </form>
        </div>
    </div>
    </div>
      <?php
      include('settings.php'); // Database connection

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $action = $_POST['action'];

          // Handle different actions
          if ($action === 'list_all') {
              // List all EOIs
              $query = "SELECT * FROM eoi";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                  echo "<div class='table-container'>";
                  echo "<table class='eoi-table'>";
                  echo "<thead><tr><th>EOI Number</th><th>Job Reference</th><th>First Name</th><th>Last Name</th><th>Status</th></tr></thead>";
                  echo "<tbody>";
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td>{$row['EOInumber']}</td><td>{$row['JobReference']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['Status']}</td></tr>";
                  }
                  echo "</tbody></table></div>";
              } else {
                  echo "<p>No EOIs found.</p>";
              }
          } elseif ($action === 'list_by_job') {
              // List EOIs by job reference number
              $jobRef = $conn->real_escape_string($_POST['jobRef']);
              $query = "SELECT * FROM eoi WHERE JobReference = '$jobRef'";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                  echo "<div class='table-container'>";
                  echo "<table class='eoi-table'>";
                  echo "<thead><tr><th>EOI Number</th><th>Job Reference</th><th>First Name</th><th>Last Name</th><th>Status</th></tr></thead>";
                  echo "<tbody>";
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td>{$row['EOInumber']}</td><td>{$row['JobReference']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['Status']}</td></tr>";
                  }
                  echo "</tbody></table></div>";
              } else {
                  echo "<p>No EOIs found for Job Reference '$jobRef'.</p>";
              }
          } elseif ($action === 'list_by_applicant') {
              // List EOIs by applicant name
              $firstName = $conn->real_escape_string($_POST['firstName']);
              $lastName = $conn->real_escape_string($_POST['lastName']);
              $query = "SELECT * FROM eoi WHERE FirstName LIKE '%$firstName%' AND LastName LIKE '%$lastName%'";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                  echo "<div class='table-container'>";
                  echo "<table class='eoi-table'>";
                  echo "<thead><tr><th>EOI Number</th><th>Job Reference</th><th>First Name</th><th>Last Name</th><th>Status</th></tr></thead>";
                  echo "<tbody>";
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr><td>{$row['EOInumber']}</td><td>{$row['JobReference']}</td><td>{$row['FirstName']}</td><td>{$row['LastName']}</td><td>{$row['Status']}</td></tr>";
                  }
                  echo "</tbody></table></div>";
              } else {
                  echo "<p>No EOIs found for the specified applicant.</p>";
              }
          } elseif ($action === 'delete_by_job') {
              // Delete EOIs by job reference number
              $jobRef = $conn->real_escape_string($_POST['jobRef']);
              $query = "DELETE FROM eoi WHERE JobReference = '$jobRef'";
              if ($conn->query($query)) {
                  echo "<p>All EOIs with Job Reference '$jobRef' have been deleted.</p>";
              } else {
                  echo "<p>Error deleting EOIs: " . $conn->error . "</p>";
              }
          } elseif ($action === 'update_status') {
              // Update EOI status
              $eoiNumber = intval($_POST['eoiNumber']);
              $status = $conn->real_escape_string($_POST['status']);
              $query = "UPDATE eoi SET Status = '$status' WHERE EOInumber = $eoiNumber";
              if ($conn->query($query)) {
                  echo "<p>Status of EOI #$eoiNumber has been updated to '$status'.</p>";
              } else {
                  echo "<p>Error updating status: " . $conn->error . "</p>";
              }
          }
      }
      ?>
    </main>
    <?php include('includes/footer.inc'); ?>
  </body>
</html>
