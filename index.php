<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header('location: users.php');
}
?>
<?php include_once 'assets/componants/headTag.php' ?>

<body class="flex justify-center items-center">
  <div class="wrapper">
    <section class="form signup">
      <header>Realtime Chat App</header>
      <form action="#" enctype="multipart/form-data" autocomplete="off">
        <!-- SHOW ERROR MESSAGE -->
        <div class="error-txt text-center"></div>
        <!-- LOGIN FORM -->
        <div class="name-details flex">
          <div class="field input">
            <input type="text" name="firstName" placeholder="First Name" />
          </div>
          <div class="field input">
            <input type="text" name="lastName" placeholder="Last Name" />
          </div>
        </div>
        <div class="field input">
          <input type="text" name="email" placeholder="Enter your Email" />
        </div>
        <div class="field input">
          <input type="password" name="password" placeholder="Enter new Password" />
        </div>
        <div class="field input image">
          <input type="file" name="image" />
        </div>
        <div class="field flex flex-col input button">
          <input type="submit" value="Continue to chat" />
        </div>
      </form>
      <div class="link text-center">
        Already have an account?<a href="login.php">Login</a>
      </div>
    </section>
  </div>
  <!-- ==== JS FILES ==== -->
  <script src="assets/js/signup.js"></script>
</body>

</html>