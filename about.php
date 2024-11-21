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
      <section id="group-info">
        <h2>Group Information</h2>
        <dl>
          <dt>Group Name</dt>
          <dd>TanPhamSuper</dd>
          <dt>Group ID</dt>
          <dd>G1010</dd>
          <dt>Tutor's Name</dt>
          <dd>Dr. Trung LUU</dd>
          <dt>Course</dt>
          <dd>Computing Technology Inquiry Project</dd>
        </dl>
      </section>

      <section id="group-photo">
        <h2>Our Team</h2>
        <figure>
          <img
            src="images/group-photo.png"
            alt="TechInnovators Team Photo"
            width="800"
            height="300"
          />
          <figcaption>The TanPhamSuper Team</figcaption>
        </figure>
      </section>

      <section id="timetable">
        <h2>Our Timetable</h2>
        <table>
          <thead>
            <tr>
              <th>Time</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
              <th>Saturday</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>7:00 - 11:00</td>
              <td>-</td>
              <td>-</td>
              <td>Computer System</td>
              <td>-</td>
              <td>-</td>
              <td>Computing Technology Inquiry Project</td>
            </tr>
            <tr>
              <td>13:00 - 17:00</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>-</td>
              <td>Networks and Switchings</td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="contact">
        <h2>Contact Us</h2>
        <p>
          You can reach our team at:
          <a href="mailto:tanmap2003@gmail.com">tanmap2003@gmail.com</a>
        </p>
      </section>

      <section>
        <h2>Member Profiles</h2>
        <div id="member-profiles">
          <div class="member">
            <h3>Tan Pham</h3>
            <p>Hometown: Vung Tau VN</p>
            <p>Skills: Python, JavaScript, React</p>
            <p>Interests: Machine Learning, Web Development</p>
            <h4>Favorites</h4>
            <ul>
              <li>Book: "Clean Code" by Robert C. Martin</li>
              <li>Movie: The Social Network</li>
              <li>Music: Electronic</li>
            </ul>
          </div>
          <div class="member">
            <h3>Tan Pham</h3>
            <p>Hometown: Vung Tau VN</p>
            <p>Skills: Java, C++, SQL</p>
            <p>Interests: Database Systems, Mobile App Development</p>
            <h4>Favorites</h4>
            <ul>
              <li>Book: "Design Patterns" by Erich Gamma et al.</li>
              <li>Movie: The Matrix</li>
              <li>Music: Classical</li>
            </ul>
          </div>
          <div class="member">
            <h3>Tan Pham</h3>
            <p>Hometown: Vung Tau VN</p>
            <p>Skills: HTML/CSS, UX Design, Node.js</p>
            <p>Interests: Front-end Development, User Experience</p>
            <h4>Favorites</h4>
            <ul>
              <li>Book: "Don't Make Me Think" by Steve Krug</li>
              <li>Movie: Inception</li>
              <li>Music: Indie Rock</li>
            </ul>
          </div>
          <div class="member">
            <h3>Tan Pham</h3>
            <p>Hometown: Vung Tau VN</p>
            <p>Skills: Python, TensorFlow, Data Analysis</p>
            <p>Interests: Artificial Intelligence, Data Science</p>
            <h4>Favorites</h4>
            <ul>
              <li>
                Book: "Artificial Intelligence: A Modern Approach" by Stuart
                Russell and Peter Norvig
              </li>
              <li>Movie: Ex Machina</li>
              <li>Music: Jazz</li>
            </ul>
          </div>
        </div>
      </section>
    </main>
    <?php include('includes/footer.inc'); ?>
  </body>
</html>



