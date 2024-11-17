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
    <main>

        <section class="sign-up-form d-flex justify-content-center align-items-center">
            <!-- <div class="container-sm">
                <form action="" class="border" style="background-color: white;">
                    <img src="public/images/ticket-logo_9850-381.png" class="row" alt="">
                    <div class="row">
                        <label for="first-name" class="form-label">First Name</label>
                        <div class="input-group">
                            <input type="text" name="first-name" id="">
                        </div>
                        <label for="last-name" class="form-label">Last Name</label>
                        <div class="input-group">
                            <input type="text" name="last-name" id="">
                        </div>
                    </div>
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="text" name="email" id="">
                    </div>
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password">
                    </div>
                </form>
            </div> -->
            <div class="form-container border d-flex flex-column justify-content-center align-items-center">
                <img src="public/images/ticket-logo_9850-381.png" class="form-logo img-fluid" alt="Logo" class="logo">
                <form>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="Enter your name" required>
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Enter your surname" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>

        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>