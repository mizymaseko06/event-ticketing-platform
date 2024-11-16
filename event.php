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
        <div class="container-fluid p-0" style="margin-top: 60px;">
            <img src="public/images/hero-background.jpg" class="img-fluid w-100" style="object-fit: cover; height: 50vh;" alt="">
        </div>
        <div class="container-sm detailed-event">
            <div class="row my-3">
                <h5 class="fw-bolder">Event</h5>
                <div class="d-flex flex-column justify-content-between mt-3">
                    <div class="details d-flex align-items-end justify-content-between">
                        <div class="d-flex flex-column">
                            <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;">Sat, 30 Nov 2024, 16:00</span></div>
                            <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;">Somhlolo National Stadium</span></div>
                        </div>
                        <span class="price fw-bold fs-5" style="color: orange">E500.00</span>
                    </div>
                </div>
                <div class="description mt-3">
                    <h5>Desciption</h5>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas quod aliquam magni iste adipisci consequuntur laudantium! Architecto, harum doloribus est id impedit ut at veniam culpa, enim voluptatem amet iste illum consequatur.</p>
                </div>


                <div class="quantities d-flex flex-column align-items-center">
                    <div class="">
                        <button class="btn btn-secondary">-</button>
                        <input type="text" class="mx-2" style="width: 30px;">
                        <button class="btn btn-secondary">+</button>
                    </div>
                    <button class="btn btn-primary mt-1" style="width: 100px">Buy</button>
                </div>


            </div>
        </div>
        <section id="similar-events">
            <div class="container">
                <h2 class="section-heading text-center">
                    Similar Events
                </h2>
                <div class="row justify-content-center">
                    <?php
                    for ($i = 0; $i < 6; $i++) {
                    ?>
                        <div class="card col-10 col-md-5 col-lg-3 m-1">
                            <p class="card-header text-end" style="background-color: white;">Category</p>
                            <img src="public/images/hero-background.jpg" class="card-img-top">
                            <div class="card-body index-card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title fw-bolder">Event</h5>
                                <!-- <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate in consequuntur, tenetur nulla autem excepturi eius?</p> -->
                                <div class="details d-flex align-items-end justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div><i class="bi bi-calendar-event me-1"></i><span class="date" style="font-size: small;">Sat, 30 Nov 2024, 16:00</span></div>
                                        <div><i class="bi bi-geo me-1"></i><span class="location" style="font-size: small;">Somhlolo National Stadium</span></div>
                                    </div>
                                    <span class="price fw-bold fs-5" style="color: orange">E500.00</span>
                                </div>
                            </div>
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