<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include "db/db_conn.php";

$sql = "SELECT eventID, eventName, date, time, location, price, image FROM events ORDER BY date";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <?php include "header.php"; ?>
    <main>

        <section id="featured">
            <div class="container">
                <h2 class="section-heading text-center">
                    All Events
                </h2>
                <div class="row justify-content-center">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="card col-10 col-md-5 col-lg-3 m-1 event-card">
                            <a href="event.php?id=<?php echo $row['eventID'] ?>" class="event-link">
                                
                                <img src="<?php echo $row['image'] ?>" class="card-img-top">
                                <div class="card-body index-card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title fw-bolder"><?php echo htmlspecialchars($row['eventName']) ?></h5>
                                    <div class="details d-flex align-items-end justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;"><?php echo date("D, d M Y, H:i", strtotime($row['date'])); ?></span></div>
                                            <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;"><?php echo htmlspecialchars($row['location']); ?></span></div>
                                        </div>
                                        <span class="price fw-bold fs-5" style="color: orange">E<?php echo number_format($row['price'], 2); ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

        </section>
    </main>

    <?php
    include "footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>