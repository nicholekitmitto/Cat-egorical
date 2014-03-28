<?php include("inc/header.php") ?>
<?php
  if (isLoggedIn() != true):
    header('Location: login.php');
  else:

?>

<?php
$db = connectToDatabase();
if ($_POST) {
    $subject = $_POST['subject'];
    $question = $_POST['question'];
    $userid = $_SESSION['userid'];
    $query = "INSERT INTO `questions` (`subject`, `question`, `created_at`, `userid`)
              VALUES ('" . $subject . "',
                      '" . $question . "',
                      '" . date('Y-m-d', time()) . "',
                      '" . $userid . "')";
  $statement = $db->prepare($query);
  $statement->execute();

  if ($statement->errorCode() == 0) {
    echo "Thanks! Your questions was recieved successfully!";
  } else {
    $errors = $statement->errorInfo();
    echo($errors[2]);
  }
}

?>

<body id="subpage">

<div class="reg-form-container vertical-center">
  <form id="questions" method="POST">
    <label for="subject" required>Subject</label>
    <input type="text" name="subject" value="" id="subject" placeholder="Subject" required>

    <label for="question" required>Question</label>
    <textarea name="question" id="question" rows="6" placeholder="Enter your Cat-y questions here!" required></textarea>

    <button type="submit" class="small round button">Submit!</button>
  </form>

  <p>Want to see what others are talking about? Head over to the <a href="forum.php">Forum</a> now!</p>
</div>

<?php
endif;
include("inc/footer.php") ?>
