<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header('location: login.php');
}
?>
<?php include_once 'assets/componants/headTag.php' ?>

<body class="flex justify-center items-center">
  <div class="wrapper">
    <section class="users">
      <header class="flex items-center">
        <div class="content flex items-center">
          <!-- GETTING USER DATA FROM DB -->
          <?php
          include_once 'assets/php/config.php';
          $sql = "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}";
          $user_query = mysqli_query($conn, $sql);
          if (mysqli_num_rows($user_query) === 1) {
            $user = mysqli_fetch_assoc($user_query);
            $img = $user['img'];
            $name = $user['firstName'] . ' ' . $user['lastName'];
            $status = $user['status'];
          }
          ?>
          <img src="<?php echo $img; ?>" alt="" />
          <div class="details">
            <span><?php echo $name; ?></span>
            <p><?php echo $status; ?></p>
          </div>
        </div>
        <a href="assets/php/logout.php?logout_id=<?php echo $user['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <input type="text" placeholder="Search Users: " />
      </div>
      <!-- GET ALL USERS DATA FROM DB -->
      <div class="users-list"></div>
    </section>
  </div>
  <!-- ==== JS FILES ==== -->
  <script src="assets/js/users.js"></script>
</body>

</html>