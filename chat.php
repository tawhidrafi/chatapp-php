<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
  header('location: login.php');
}
?>
<?php include_once 'assets/componants/headTag.php' ?>

<body class="flex justify-center items-center">
  <div class="wrapper">
    <section class="chat-area">
      <header class="flex items-center">
        <!-- GETTING USER DATA FROM DB -->
        <?php
        include_once 'assets/php/config.php';
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = "SELECT * FROM users WHERE unique_id = {$user_id}";
        $user_query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($user_query) === 1) {
          $user = mysqli_fetch_assoc($user_query);
          $img = $user['img'];
          $name = $user['firstName'] . ' ' . $user['lastName'];
          $status = $user['status'];
        }
        ?>
        <a href="users.php" class="back-icon">@</a>
        <img src="<?php echo $img; ?>" alt="" />
        <div class="details">
          <span><?php echo $name; ?></span>
          <p><?php echo $status; ?></p>
        </div>
      </header>
      <div class="chat-box"></div>
      <form action="#" class="typing-area flex">
        <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden />
        <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden />
        <input type="text" name="message" id="message" placeholder="Type your message" />
        <button type="submit">Send</button>
      </form>
    </section>
  </div>
  <!-- ==== JS FILES ==== -->
  <script src="assets/js/chat.js"></script>
</body>

</html>