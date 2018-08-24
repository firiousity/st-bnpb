<body>
<div class="view hm-black-light jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url('https://cdn.dribbble.com/users/720472/screenshots/2177275/gif.gif'); height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover; ">
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
<div class="container center">
	<section>
		<div class="flex-center" style="margin-top: 1%">
                <!-- <div class="text-center">
                    <h1 class="animated fadeIn mb-2">Sistem Persuratan</h1>
                    <h5 class="animated fadeIn mb-1">Badan Nasional Penanggulangan Bencana</h5>                    
                </div> -->
			<!-- Default form login -->
			<form class="text-center p-4" method="post" action="<?php  echo base_url('home/login')?>">
				<p class="h4 mb-4">Sign in</p>
				<!-- Email -->
				<input type="text" id="defaultLoginFormEmail" class="form-control mb-4" name='name' placeholder="username" required>
				<!-- Password -->
				<input type="password" id="defaultLoginFormPassword" class="form-control mb-4" name='password' placeholder="password" required>
				<div class="d-flex justify-content-around">
					<div>
						<!-- Remember me -->
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
							<label class="custom-control-label" style="color: white"><strong>Remember me</strong> </label>
						</div>
					</div>
				</div>
    <!-- Sign in button -->
				<button class="btn btn-indigo my-4">Sign in</button>
			</form>
	</section>
<!-- Default form login -->
</div>
<?php if (isset($_SESSION['error'])): ?>
    <script>
      swal({
          title: "Error!",
          text: "<?php echo $_SESSION['error'] ?>",
          type: "error"
      });
    </script>
<?php unset($_SESSION['error']) ?>
<?php endif ?>
</body>

</html>
