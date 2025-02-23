<?php
$servername = "sql102.infinityfree.com";
$username = "if0_38356551";
$password = "x5AdReNBSY";
$dbname = "if0_38356551_adernporo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Create an Account</h1>
    <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $result->fetch_assoc()['id'];
        header("Location: user_dashboard.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>
</body>
</html>
<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql_balance = "SELECT balance FROM users WHERE id = '$user_id'";
$result_balance = $conn->query($sql_balance);
$balance = $result_balance->fetch_assoc()['balance'];

$sql_referrals = "SELECT COUNT(*) AS referral_count FROM referrals WHERE referrer_id = '$user_id'";
$result_referrals = $conn->query($sql_referrals);
$referral_count = $result_referrals->fetch_assoc()['referral_count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <p>Your balance: <?= $balance ?> ৳</p>
    <p>Your referral count: <?= $referral_count ?></p>

    <h2>Withdrawal Request</h2>
    <form method="POST" action="withdraw.php">
        <input type="number" name="amount" placeholder="Amount" required>
        <button type="submit">Withdraw</button>
    </form>

    <a href="user_ads.php">View Ads</a>
</body>
</html>
<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$ads = [
    "https://www.effectiveratecpm.com/m9r4kcttvd?key=a2e57632c813b51dec2185ece53d28a7",
    "https://www.effectiveratecpm.com/wm1stj3m9q?key=ab3ddf933ccb2ad4c82e9cdf141808d3",
    "https://www.effectiveratecpm.com/dxdg86c3?key=03c54ce7953777c89700a17db7079c3b",
    "https://www.effectiveratecpm.com/udzz9kxdnt?key=b76cee1368a530cbab09b5781bb820e8",
    "https://www.effectiveratecpm.com/zvyi2nfhix?key=bdc2c15dea8c8350a6e05e23e3e49044",
    "https://www.effectiveratecpm.com/jmfzb3nw?key=26a183bfb1471fed4e869980d6740245",
    "https://www.effectiveratecpm.com/ny28qc9dv2?key=2d89db17799bb51197aca9c159968045",
    "https://www.effectiveratecpm.com/sh9ciets?key=a4d90dc2105bebd7bb0d96e7c55a9e7d",
    "https://www.effectiveratecpm.com/q0fdetzjn4?key=3507f76f766ff865d8c6b712f5a32a19",
    "https://www.effectiveratecpm.com/td8152sa5?key=ec7a4d4a10f08b099d5b929d4d776ebe",
    "https://www.effectiveratecpm.com/wp883mjh?key=0092d217ee78c6f1c710e50c9b6243c8",
    "https://www.effectiveratecpm.com/yj7z4gzk7b?key=53b94bebddd65c55d8206908c2c16f4e",
    "https://www.effectiveratecpm.com/k8290fkcn?key=0213899e21f129d9abc36d40b92de665",
    "https://www.effectiveratecpm.com/evk671kwh?key=ac72ddbada623a3d475c760731952e35",
    "https://www.effectiveratecpm.com/kqz2pbjk0?key=54ded549eeb49322ebbaeb1517a53d94",
    "https://www.effectiveratecpm.com/pp4iints3?key=a71e04579ca90a1647c46ea3204ad491",
    "https://www.effectiveratecpm.com/na6fmeck?key=ae2284ff22615a433ab886234b2d9c5a",
    "https://optidownloader.com/1772392",
    "https://optidownloader.com/1786916",
    "https://optidownloader.com/1786915",
    "https://optidownloader.com/1786912",
    "https://optidownloader.com/1786914",
    "https://optidownloader.com/1786911",
    "https://optidownloader.com/1786910",
    "https://optidownloader.com/1786909",
    "https://optidownloader.com/1786908",
    "https://optidownloader.com/1786906",
    "https://optidownloader.com/1786905",
    "https://optidownloader.com/1786904",
    "https://optidownloader.com/1786903",
    "https://optidownloader.com/1786900",
    "https://optidownloader.com/1786899",
    "https://optidownloader.com/1786896",
    "https://optidownloader.com/1786898",
    "https://www.effectiveratecpm.com/r5jpwzry?key=0bb027b08109f016d90a7b2f4d36323d",
    "https://www.effectiveratecpm.com/na6fmeck?key=ae2284ff22615a433ab886234b2d9c5a",
    "https://www.effectiveratecpm.com/sh9ciets?key=a4d90dc2105bebd7bb0d96e7c55a9e7d",
    "https://www.effectiveratecpm.com/q0fdetz