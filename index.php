<?php
$message = "";
if (count($_POST) > 0) {
    $isSuccess = 0;
    $conn = mysqli_connect("localhost", "root", "", "simplelogin");
    $userName = $_POST['userName'];
    $sql = "SELECT * FROM users WHERE userName= ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $userName);
    $statement->execute();
    $result = $statement->get_result();
    while ($row = $result->fetch_assoc()) {
        if (! empty($row)) {
            $hashedPassword = $row["password"];
            if (password_verify($_POST["password"], $hashedPassword)) {
                $isSuccess = 1;
            }
        }
    }
    if ($isSuccess == 0) {
        $message = "Invalid Username or Password!";
    } else {
        header("Location:  ./success-message.php");
    }
}
?>
<html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/form.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="phppot-container tile-container">

		<form name="frmUser" method="post" action="">
			<div class="message text-center"><?php if($message!="") { echo $message; } ?></div>

			<h1 class="text-center">Login</h1>

			<div>
				<div class="row">
					<label> Username </label> <input type="text" name="userName"
						class="full-width" " required>
				</div>
				<div class="row">
					<label>Password</label> <input type="password" name="password"
						class="full-width" required>
				</div>
				<div class="row">
					<input type="submit" name="submit" value="Submit"
						class="full-width ">
				</div>
			</div>
		</form>
	</div>
	</div>
</body>
</html>


