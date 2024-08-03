

    <!--Page Title-->
    <section class="page-title" style="background-color: #373435">
    	<div class="auto-container">
        	<h2>Contact Us</h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Contact Form Section -->
	<section class="contact-form-section" style="background-image:url(./public/themes/bappeda/images/background/contact.png)">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h2><?= $nav ?></h2>
				<div class="text">Anda dapat menghubungi kami melalui form yang tersedia di bawah ini.</div>
			</div>
			
			<div class="row clearfix">
				
				<!-- Form Column -->
				<div class="form-column col-lg-7 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!-- Contact Form -->
						<div class="contact-form">
								
							<!--Contact Form-->
							<form method="post" action="" >
								<div class="row clearfix">
									<div class="form-group col-lg-6 col-md-6 col-sm-12">
										<input type="text" name="username" placeholder="Nama Anda" required>
									</div>
									
									<div class="form-group col-lg-6 col-md-6 col-sm-12">
										<input type="text" name="email" placeholder="Email address" required>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<input type="text" name="subject" placeholder="Subject" required>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<textarea name="message" placeholder="Pesan "></textarea>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<button class="theme-btn btn-style-one" type="submit" name="submit-form">
                                        <span class="txt">Submit now</span></button>
									</div>
								</div>
							</form>
						</div>
						
					</div>
				</div>
				
				<!-- Info Column -->
				<div class="info-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>ALamat :</strong><br><?= $web['alamat'] ?></li>
						</ul>
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>Phone : </strong><a href="tel:<?= $web['hp'] ?>"><?= $web['hp'] ?></a></li>
							<li><strong>Email : </strong><a href="mailto:bestieindonesianews@gmail.com">bestieindonesianews@gmail.com</a></li>
						</ul>
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>Jam Operasional :</strong><br>8:00 AM – 16:00 PM <br/> Senin – Jum'at</li>
						</ul>
						
					</div>
				</div>
				
			</div>
			
		</div>
	</section>
	<!-- End Contact Form Section -->
	
	<!-- Map Section -->
    <section class="map-section">
        <div class="outer-container">
            <div class="map-outer">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7948.156400968905!2d105.49734037770997!3d-5.09105709999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40919abc059c59%3A0xd4d745685903a863!2sMulyo%20Asri!5e0!3m2!1sen!2sid!4v1712810562729!5m2!1sen!2sid" width="1400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>     </div>
</section>
    <!-- End Map Section -->
	


