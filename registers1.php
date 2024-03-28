<?php
session_start();

$host = 'localhost';
$dbname = 'Junsuriya';
$username = 'root';
$password = 'root';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูล Room ที่ Availability เป็น Vacant room
$sql = "SELECT Room_ID, Room_Number FROM Room WHERE Availability = 'Vacant room'";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลที่ส่งมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $roomID = $_POST['room'];

    // เพิ่มการตรวจสอบเงื่อนไขต่าง ๆ ตามที่คุณต้องการ

    // ตรวจสอบว่ามีการเลือกห้องจากฟอร์มหรือไม่
    if (!empty($roomID)) {
        // เตรียมคำสั่ง SQL สำหรับการเพิ่มข้อมูลผู้ใช้ลงในฐานข้อมูล
        $sql = "INSERT INTO Member (Mem_Username, Mem_Password, Mem_Name, Mem_Contect, Room_ID) VALUES ('$username', '$password', '$name', '$phone', '$roomID')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Please select a room.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save user information</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .title {
            color: #5a4c94;
            padding: 20px;
        /* เพิ่มความห่างด้านล่าง */
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #dddaeb; 
        }


        .container {
            max-width: 500px;
            width: 80%;
            background-color: #ffffff;
            padding: 10px 35px; /* ลดความสูงของกล่องโดยลดค่า padding-top และ padding-bottom */
            border-radius: 50px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            text-align: center; /* Center the title */
        }

        .user-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px 0 12px 0;
        }

        .input-box {
            position: relative;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            text-align: left;
        }

        .input-box label {
            font-size: 16px;
            font-weight: bold;
            color: #555555; /* เปลี่ยนสีข้อความ label */
        }

        .input-box input[type="text"],
        .input-box input[type="password"],
        .input-box input[type="tel"],
        .input-box select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc; /* เปลี่ยนสีเส้นขอบ input */
            border-radius: 5px;
            box-sizing: border-box;
        }

        .input-box select {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='rgba(0,0,0,0.5)' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'><path d='M7.41 8.58L12 13.17l4.59-4.59L18 10l-6 6-6-6z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
            cursor: pointer;
        }

        .input-box input:focus,
        .input-box select:focus {
            outline: none;
            border-color: #4f4990; /* เปลี่ยนสีเส้นขอบเมื่อ focus */
        }

        .input-box span {
            font-size: 14px;
            color: #cc0000; /* เปลี่ยนสีข้อความเมื่อมี error */
        }

        .input-box input {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 15px;
            padding-left: 40px;
            border: 1px solid #4f4990;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .input-box input:focus,
        .input-box input:valid {
            border-color: #4f4990;
        }
        .button {
            height: 45px;
            margin: 35px 0;
        }

        .button input {
            height: 100%;
            width: 100%;
            border-radius: 15px;
            border: none;
            color: #ffffff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #978ff4, #4f4990);
        }

        .button input:hover {
            background: linear-gradient(-135deg, #978ff4, #4f4990);
        }

        .gender-details {
            text-align: center;
            font-size: 14px;
            color: #4f4990;
        }

    </style>
</head>
<body>
    
    <div class="container">
        <div class="title">Save user information</div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-box">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="input-box">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" maxlength="10" required>
            </div>

            <div class="input-box">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="input-box">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
            </div>

            <div class="input-box">
                <label for="room">Room:</label>
                <select id="room" name="room" required>
                    <option value="">Select Room</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["Room_ID"] . "'>" . $row["Room_Number"] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No available rooms</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="button">
                    <input type="submit"  class="btn btn-primary"  value="Register"></input>
                </div>
        </form>
    </div>
</body>


</html>