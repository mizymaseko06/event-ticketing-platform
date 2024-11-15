<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">

</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="public/images/ticket-logo_9850-381.png" class="img-fluid" style="max-height: 40px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">How It Works</a>
                        </li>

                        </li>
                    </ul>

                    <div class="d-flex align-content-center">
                        <p class="nav-item white-text">My tickets</p>
                        <p class="nav-item white-text">E200.00</p>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section id="hero">
            <div class="container" style="padding-top: 200px;">
                <div class="row">
                    <div class="col-10 col-md-10 col-lg-5">
                        <h1 class="fw-bolder" style="color: white;">DISCOVER EVENTS. BUY TICKETS. ENJOY THE EXPERIENCE!</h1>
                        <p class="lead" style="color: white;">Join the excitement! Browse upcoming events and reserve your spot today.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="featured">
            <div class="container">
                <h2 class="section-heading text-center">
                    Featured Events
                </h2>
                <div class="row justify-content-center">
                    <?php
                    for ($i = 0; $i < 6; $i++) {
                    ?>
                        <div class="card col-10 col-md-5 col-lg-3 m-1">
                            <p class="card-header text-end" style="background-color: white;">Category</p>
                            <img src="public/images/hero-background.jpg" class="card-img-top">
                            <div class="card-body">
                                <h6 class="card-title">Event</h6>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate in consequuntur, tenetur nulla autem excepturi eius?</p>
                                <div class="details d-flex align-items-end justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span class="date">Sat, 30 Nov 2024, 16:00</span>
                                        <span class="location">Somhlolo National Stadium</span>
                                    </div>
                                    <span class="price">E500.00</span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>

        </section>

        <section id="how-it-works">
            <div class="container">
                <h2 class="section-heading text-center">
                    How It Works
                </h2>

                <div class="row d-flex justify-content-center">

                    <div class="d-flex flex-row align-items-center col-7 mb-3">
                        <div class="image w-25">
                            <img src="public/images/rb_3598.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Find events</h3>
                            <p>Browse a variety of events tailored to your interests and location.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center col-7 mb-5">
                        <div class="image w-25">
                            <img src="public/images/rb_96.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Purchase tickets</h3>
                            <p>Reserve your spot by purchasing tickets with just a few clicks.</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center col-7 mb-5">
                        <div class="image w-25">
                            <img src="public/images/rb_1749.png" class="img-fluid" alt="">
                        </div>
                        <div>
                            <h3>Get ready to go!</h3>
                            <p>Receive confirmation and all the info you need to make most of your event.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="container-fluid" style="background-color: black;">
            <p class="lead text-center white-text pt-4">Ready to make memories? Start exploring now!</p>
            <div class="row d-flex flex-row justify-content-center">
                <div class="col-lg-5 col-sm-10 d-flex flex-column align-items-lg-end align-items-sm-center text-center text-md-end my-3">
                    <div>

                        <h5 style="color: orange;">Site Map</h5>
                        <div id="site-map" class="d-flex flex-column">
                            <span><a href="">Events</a></span>
                            <span><a href="">About Us</a></span>
                            <span><a href="">FAQ</a></span>
                            <span><a href="">Privacy Policy</a></span>
                            <span><a href="">Terms of service</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-10 d-flex flex-column align-items-lg-start align-items-sm-center text-center text-md-start m-3">
                    
                    <h5 style="color: orange;">Contact</h5>
                    <div class="d-flex flex-column">
                        <span class="white-text">Phone: 2404 0000</span>
                        <span class="white-text">Email: ask@events.co.sz</span>
                        <div class="icons">
                            <img class="social-links" src="public/images/Facebook.png" alt="">
                            <img class="social-links" src="public/images/Instagram.png" alt="">
                            <img class="social-links" src="public/images/TwitterX.png" alt="">
                            <img class="social-links" src="public/images/LinkedIn Circled.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>