<?php
require_once ('header.php');
?>
<body>

    <!-- Start your project here-->
    <div style="height: 100vh">
        <div class="flex-center flex-column">

<!-- Default form login -->
<form class="text-center border border-light p-5">

    <p class="h4 mb-4">Sign in</p>

    <!-- Email -->
    <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
            </div>
        </div>
        <div>
            <!-- Forgot password -->
            <a href="">Forgot password?</a>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

</form>
<!-- Default form login -->
            <h1 class="animated fadeIn mb-2">Material Design for Bootstrap</h1>

            <h5 class="animated fadeIn mb-1">Thank you for using our product. We're glad you're with us.</h5>

            <p class="animated fadeIn text-muted">MDB Team</p>
        </div>

    </div>
    
</body>

</html>
