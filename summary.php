<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุป - Junsuriya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css"> <!-- เพิ่มไฟล์ CSS -->
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar"> <!-- ใช้คลาส custom-navbar -->
        <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active mx-2" aria-current="page" href="#">Home</a> <!-- เพิ่มคลาส mx-2 -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="#">ชำระเงิน</a> <!-- เพิ่มคลาส mx-2 -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="report.php">แจ้งปัญหา</a> <!-- เพิ่มคลาส mx-2 -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="report_repair.php">แจ้งซ่อม</a> <!-- เพิ่มคลาส mx-2 -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="report_repair.php">รายงานสรุป</a> <!-- เพิ่มคลาส mx-2 -->
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="logout.php">Logout</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</header>

<main class="container">
    <br><br>
    <h1 class="text-center">รายงานสรุป</h1>
    <br><br>

    <!-- เพิ่ม input สำหรับเลือกเดือนและปี -->
    <div class="row justify-content-center">
        <div class="col-md-4">
            <label for="monthyear">เลือกเดือนและปี:</label>
            <input type="month" id="monthyear" name="monthyear" class="form-control">
        </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
