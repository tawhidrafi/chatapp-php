<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header('location: users.php');
}
?>
<?php include_once 'assets/componants/headTag.php' ?>

<body class="flex justify-center items-center">
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
      <form action="#" autocomplete="off">
        <!-- SHOW ERROR MESSAGE -->
        <div class="error-txt text-center"></div>
        <!-- LOGIN FORM -->
        <div class="field input">
          <input type="text" name="email" placeholder="Enter your Email" />
        </div>
        <div class="field input">
          <input type="password" name="password" placeholder="Enter your Password" />
        </div>
        <div class="field input button">
          <input type="submit" value="Continue to chat" />
        </div>
      </form>
      <div class="link text-center">
        No account?<a href="index.php">Signup Now</a>
      </div>
    </section>
  </div>
  <!-- ==== JS FILES ==== -->
  <script src="assets/js/login.js"></script>
</body>

</html>