<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Swinburne Company</title>
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <?php include('includes/menu.inc'); ?>
    <main class="main-content">
      <div class="apply_title">
        <h1>Job Application Form</h1>
      </div>
      <form
        action="processEOI.php" method="POST" novalidate
      >
        <label for="job-reference">Job Reference Number:</label>
        <input
          type="text"
          id="job-reference"
          name="jobRef"
          pattern="[a-zA-Z0-9]{5}"
          required
        />

        <label for="first-name">First Name:</label>
        <input
          type="text"
          id="first-name"
          name="firstname"
          maxlength="20"
          pattern="[A-Za-z]+"
          required
        />

        <label for="last-name">Last Name:</label>
        <input
          type="text"
          id="last-name"
          name="lastname"
          maxlength="20"
          pattern="[A-Za-z]+"
          required
        />

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required />

        <fieldset>
          <legend>Gender:</legend>
          <label
            ><input type="radio" name="gender" value="Male" required />
            Male</label
          >
          <label
            ><input type="radio" name="gender" value="Female" /> Female</label
          >
          <label
            ><input type="radio" name="gender" value="Other" /> Other</label
          >
        </fieldset>

        <label for="street-address">Street Address:</label>
        <input
          type="text"
          id="street-address"
          name="streetAddress"
          maxlength="40"
          required
        />

        <label for="suburb">Suburb/Town:</label>
        <input type="text" id="suburb" name="suburb" maxlength="40" required />

        <label for="state">State:</label>
        <select id="state" name="state" required>
          <option value="">Select a state</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>

        <label for="postcode">Postcode:</label>
        <input
          type="text"
          id="postcode"
          name="postcode"
          pattern="[0-9]{4}"
          required
        />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Phone Number:</label>
        <input
          type="tel"
          id="phone"
          name="phone"
          pattern="[0-9 ]{8,12}"
          required
        />

        <fieldset>
          <legend>Skills:</legend>
          <label
            ><input type="checkbox" name="skills[]" value="Programming" />
            Programming</label
          >
          <label
            ><input type="checkbox" name="skills[]" value="Design" />
            Design</label
          >
          <label
            ><input type="checkbox" name="skills[]" value="Communication" />
            Communication</label
          >
          <label
            ><input
              type="checkbox"
              name="skills[]"
              value="Project Management"
            />
            Project Management</label
          >
          <label
            ><input type="checkbox" name="skills[]" value="Other" /> Other
            skills...</label
          >
        </fieldset>

        <label for="other-skills">Other Skills:</label>
        <textarea
          id="other-skills"
          name="otherSkills"
          rows="4"
          placeholder="Describe other skills here..."
        ></textarea>

        <button type="submit">Apply</button>
      </form>
    </main>
    <?php include('includes/footer.inc'); ?>
  </body>
</html>
