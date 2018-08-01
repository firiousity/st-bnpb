<?php
require_once ('header.php');
?>
<body>
<div class="view hm-black-light jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url('<?php echo base_url()."assets/img/2.jpg";?>');height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; ">
    <div class="full-bg-img">
        <div class="container flex-center">
            <div class="row pt-5 mt-3">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Start your project here-->
    <div style="height: 100vh">
        <div class="flex-center flex-column">
            <section>
                <div class="text-center">
                    <h1 class="animated fadeIn mb-2">Sistem Persuratan</h1>
                    <h5 class="animated fadeIn mb-1">Badan Nasional Penanggulangan Bencana</h5>                    
                </div>
            </section>
            <br>
<section>
<!-- Default form login -->
<form class="text-center border border-light p-5" method="post" action="<?php  echo base_url('home/login')?>">

    <p class="h4 mb-4">Sign in</p>

    <!-- Email -->
    <input type="text" id="defaultLoginFormEmail" class="form-control mb-4" name='name' placeholder="E-mail" required>

    <!-- Password -->
    <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" name='password' placeholder="Password" required>
    
    <div class="d-flex justify-content-around">
        <div>
            <!-- Remember me -->
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
            </div>
        </div>
        <div>
            <br>
            <!-- Forgot password -->
            <a href="">Forgot password?</a>
        </div>
    </div>

    <!-- Sign in button -->
    <button class="btn btn-info btn-indigo btn-block my-4">Sign in</button>

</form>
</section>
<!-- Default form login -->
        </div>
</div>
</body>

</html>
