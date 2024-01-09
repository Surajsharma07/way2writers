<?php
    $ASSET_URL = asset('user-theme') . '/';
    $setting = getSetting();
    $price_symbol = $setting->default_symbol ?? '$';
?>

<link href="https://www.way2writers.com/css/stylesheet.css" rel="stylesheet">

<?php $__env->startSection('content'); ?>
<section class="intro-video cus-row">
		<div class="who">
			<div class="col-sm-12 text-center">
				<div class="row">
					<div class="col-md-8" style="
    padding: 0px;
">
		
						<div class="col-md-11 col-xs-12">
							<h3 align="left" class="mrgT10"><strong>WHO WE ARE?</strong></h3>
							<p class="sub-heading"> We are a pool of handpicked <strong>professional writers</strong> specialized in diverse fields of resume writing.</p>
							<p> Our team of professional resume writers and client-service staff is always at your disposal to help you achieve the same. Our writer network comprises of career coaches & professionals with expertise in over <strong>50 industries</strong> across over <strong>100 functional areas.</strong> We have a dedicated team continuously working towards crafting a bright future for you. 
							</p>
							<div class="we-offer">
								<h4>What we offer?	</h4>
								<p>We provide powerfully written and well-presented content for offering significant advantage over other job applicants. We offer personalized services with a perfect writer to express your career story in the best possible manner.</p>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row" style="max-width:400px;">
							<div class="video-pane">
								<div class="video">
									<iframe  src="https://www.youtube.com/embed/n19YSckyPo8" encrypted-media allowfullscreen style="width: 100%; border:none; height:170px;"></iframe>
								</div>
							<h4>Key Benefits</h4>
							<ul>
								<li>Customised format & content</li>
								<li>Reasonable & pocket-friendly</li>
								<li>Keywords Rich, ATS Compliant</li>
								<li>Quality Checked profiles</li>
							</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="gray-left-skew colofff"></div>
        </div>
	</section>    
<section>
        <!--===How Work Start===-->
        
    <article class="recrutment-section bigdownarr">
		<h2>INVEST FOR YOUR CAREER, WITH A SEO OPTIMIZED RESUME</h2>
		<p class="font18">Our <span class="colorcd22">writing experts</span> will prepare a perfect resume for you</p>
	</article>
	
	<section class="services-block">
      <div class="invest">
		<div class="row">
			<section class="col-sm-4">
				<article class="media resume-services">
					<div class="pull-left pos_cnt"><img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/spacer.gif" class="posover icon-stat" /></div>
					<div class="media-body pos_cnt">
						<div class="position">
							<p><span style="font-size:25px;">38%</span> of more probability of getting <strong>contacted by recruiters</strong></p>
						</div>

					</div>

				</article>

			</section>

			<section class="col-sm-4">

				<article class="media resume-services">
					<div class="pull-left pos_cnt"><img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/spacer.gif" class="posover icon-stat icon-31" /></div>
					<div class="media-body pos_cnt">
						<div class="position">
						<p><span style="font-size:25px;">31%</span> higher chances of getting <strong>shortlisted for an interview</strong></p>
						</div>
					</div>
				</article>
			</section>

			<section class="col-sm-4">
				<article class="media resume-services">
					<div class="pull-left pos_cnt"><img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/spacer.gif" class="posover icon-stat icon-40" /></div>
					<div class="media-body pos_cnt">
						<div class="position">
						<p><span style="font-size:25px;">40%</span> greater chances to get your <strong>dream job</strong></p>
						</div>
					</div>
				</article>
			</section>
		</div>
    </div>
	</section>
        
        <!--===IHow Work End===-->
        <!--===Categories Section Start===-->
        
        <!--===Categories Section End===-->
       
		<article class="recrutment-section bigdownarr whitedownarr">
			<h2>Choose your resume type</h2>
			<p class="font18">It is <strong>equally important</strong> that your resume catches the eye of the top & relevant job consultants</p>
		</article>
      
		<div class="col-sm-12 accordian">
          <div class="choose">
<div class="nav-box justify-content-center">
			<ul class="nav nav-pills nav-fill" role="tab">
    <?php $__currentLoopData = $featured_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e($index === 0 ? 'active' : ''); ?>" href="javascript:void(0)"><?php echo e($row->name); ?></a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>

          
			<section class="content" style="display:block;">

				<article class="content-wrap-block col-sm-12">
					<a class="example-image-link zoomicon" href="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/zoom/Infographic Resume.jpg" data-lightbox="example-1" data-title="Infographic Resume">
						<img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/infographic.jpg" class="mfl-rightnone" alt="author" />
					</a>
					<h3>Infographic Resume</h3>
					<div class="mrgR10 textJ">
					<p>As per the research, a human mind responds to a visual storytelling faster as the images grab our attention. A resume is the most important personal marketing tool designed to engage the hiring manager, get you to the interview, and eventually land you in the job. We take the information in text or numerical form and then condense the same into a combination of images &amp; text, allowing viewers to quickly grasp the essential insights of the data. Recruiters review thousands of resumes on a daily basis and if you can find a way to differentiate yourself, you should take that opportunity.</p>
						<ul>
							<li><i class="fa fa-angle-right" aria-hidden="true"></i>Best images to represent your career with balanced mixture of color and graph charts</li>
							<li><i class="fa fa-angle-right" aria-hidden="true"></i>Crisp &amp; concise professional document</li>
							<li><i class="fa fa-angle-right" aria-hidden="true"></i>Eye-catchy and easy-to- read format</li>
							<li><i class="fa fa-angle-right" aria-hidden="true"></i>Visual story of your career in one frame</li>
						</ul>
					</div>
					<a href="http://localhost/newway/services/infographic-resume" class="btn btn-primary">Buy Now</a>
				</article>
			</section>

			<section class="content">

				<article class="content-wrap-block col-sm-12">                
                   <a class="example-image-link zoomicon" href="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/zoom/Visual-Sample.jpg" data-lightbox="example-1" data-title="Visual Resume">
					<img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/Visual Sample.jpg" class="mfl-rightnone" alt="author" />
                   </a> 

					<h3>Visual Resume</h3>
					<div class="mrgR10 textJ">
					<p>Rightly said ‘first impression is the last impression’; the visual resume ensures that the first glance to your resume creates a lasting impact on the minds of the recruiter. We merge the textual component of your career story with a cohesive color scheme and visual theme in orderly, coordinated manner. A visual resume helps you to create a distinctive personal brand for yourself (logos, nice selection of fonts, etc.) and an opportunity to show off your abilities.</p>
					<ul>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Key attributes converted into a visually stunning &amp; impactful resume</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Structured and presentable look with rich keywords</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Designed as per experience level</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Perfect format &amp; language structure</li>
					</ul>
					</div>
					<a href="http://localhost/newway/services/visual-resume" class="btn btn-primary">Buy Now</a>
				</article>
			</section>

			<section class="content">

				<article class="content-wrap-block col-sm-12">
                   <a class="example-image-link zoomicon" href="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/zoom/Textual Sample.jpg" data-lightbox="example-1" data-title="Textual Resume">
					<img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/textual.jpg" class="mfl-rightnone" alt="author" />
                    </a>

					<h3>Textual Resume </h3>
					<div class="mrgR10 textJ">
					<p>It is a powerfully-written resume with a concise profile summary highlighting your experience and qualifications in unique manner. The core skills section of the resume contain phrases that describe specific skills and areas of expertise to ensure that your resume is filtered as the best match for the job they want to fill. In the Experience section, a career story is weaved in a professional manner highlighting your accomplishments to illuminate your strengths.</p>
					<ul>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Tailor made resumes developed post discussion</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Repleted with industry rich keywords</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Applicant Tracking System (ATS) Compliant</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Notable Accomplishments highlighted in a bulleted format</li>
					</ul>
					</div>
					<a href="http://localhost/newway/services/textual-resume" class="btn btn-primary">Buy Now</a>
				</article>
			</section>
			
			<section class="content">

				<article class="content-wrap-block col-sm-12">
                  <a class="example-image-link zoomicon" href="<?php echo e($ASSET_URL); ?>assets/images/my_images/images//zoom/Social Profile.jpg" data-lightbox="example-1" data-title="Social Profile">
					<img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/Social-Profile.jpg" class="mfl-rightnone" alt="author" />
                  </a>

					<h3>Social Profile</h3>
					<div class="mrgR10 textJ">
					<p>As per the present scenario, social platforms are constantly evolving &amp; adding features to help you get the most out of connecting with others, especially for professional reasons. We enhance your social image by incorporating great keywords including your headline, summary, interests, job titles, job descriptions and skills. Social Profile is the best way to get noticed by creating a portfolio of work examples.</p>
					<ul>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Over 75% candidates changed their jobs through LinkedIn</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Create a strong social media presence with a strong LinkedIn profile</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> 60% of the recruiters use LinkedIn as a recruitment tool</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Expert tips to enhance your visibility in the social job market</li>
					</ul>
					</div>
                  
					<a href="http://localhost/newway/services/social-profile" class="btn btn-primary">Buy Now</a>
                    
				</article>
			</section>
            
            <section class="content">

				<article class="content-wrap-block col-sm-12">
                    <a class="example-image-link zoomicon" href="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/zoom/International Resume.jpg" data-lightbox="example-1" data-title="International Resume">
					<img src="<?php echo e($ASSET_URL); ?>assets/images/my_images/images/sample1/international.jpg" class="mfl-rightnone" alt="author" />
                    </a>

					<h3>International Resume</h3>

					<div class="mrgR10 textJ">

					<p>Whether you are looking for your 1st professional international job or you are applying for your first internship position abroad, you should be aware about the differences between international & domestic resumes.  This resume would work wonders for you if you are planning to work overseas. Country specific formats are an added advantage when you are applying internationally.</p>

					<ul>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Different Country Specific formats & keywords</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Effective in an international work environment</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Ideal resume to highlight your professional skills & personality traits as per employer's "ideal profile"</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Cross-cultural skills highlighted in terms of work environment</li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i> Location specific content & language designed in a personalized manner</li>
					</ul>

					</div>
					<a href="http://localhost/newway/services/international-resume" class="btn btn-primary">Buy Now</a>
				</article>

			</section>

		</div><!--//container--> 
       </div>

        <!--=== Why Choose Start===-->
        <div class="tp_howwork_section tp_whychoose_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tp_main_heading">
                            <h2><?php echo app('translator')->get('master.home.Why_Choose_Us'); ?></h2>
                            <p><?php echo app('translator')->get('master.home.Why_Choose_heading'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php if($why_choose_us->count() > 0): ?>
                        <?php $color = ['tp_work_box_blue','tp_work_box_red','tp_work_box_blue','tp_work_box_green','tp_work_box_green'] ?>
                        <?php $__currentLoopData = $why_choose_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="tp_work_box <?php echo e($color[$key]); ?>">
                                    <img src="<?php echo e($val->image); ?>" alt="<?php echo e($val->heading); ?>" />
                                    <h4><?php echo e($val->heading); ?></h4>
                                    <p><?php echo e($val->sub_heading); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--=== Why Choose End===-->
        <!--===Testimonial Slider Start===-->
        <?php if(!empty($testimonials) && count($testimonials) > 0): ?>
            <div class="tp_uikit_section tp_Testimonial_section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tp_main_heading">
                                <h2><?php echo app('translator')->get('master.home.testimonials_title'); ?></h2>
                                <p>
                                    <?php echo app('translator')->get('master.home.testimonials_heading'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="swiper-slide">
                                            <div class="tp_test_main">
                                                <div class="tp_test_img">
                                                    <img src="<?php echo e($item->image); ?>" alt="Image" />
                                                </div>
                                                <div class="tp_test_text">
                                                    <p>
                                                        <?php echo e($item->message); ?>

                                                    </p>
                                                    <div class="tp_test_quote">
                                                        <img src="<?php echo e($ASSET_URL); ?>assets/images/border.png"
                                                            alt="Image" />
                                                        <h5><?php echo e($item->name); ?></h5>
                                                        <?php if($item->is_checked_designation): ?>
                                                            <h6><?php echo e($item->designation); ?></h6>
                                                        <?php endif; ?>
                                                        <div class="star_rating">
                                                            <?php echo $__env->make('frontend.include.rating', [
                                                                'testimonialRating' => true,
                                                                'rating' => @$item->rating,
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
            </div>
        <?php endif; ?>
        <!--===Testimonial Slider End===-->
    </section>
      <!--===Top Selling Section Start===-->
        <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Counts JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<div class="tp_howwork_section tp_whychoose_section" style="
    padding: 0px;
">            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tp_main_heading">
<h2 style="text-decoration: underline rgb(204,51,51);">Achievements</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                  
                        <?php $color = ['tp_work_box_blue','tp_work_box_red','tp_work_box_blue','tp_work_box_green','tp_work_box_green'] ?>

                            <div class="col-lg-3 col-md-6">
                                <div class="tp_work_box tp_work_box_blue" style="background: none;">
<h1 data-toggle="counterUp" class="achievnum">15</h1>
                                    <h4>+ Years</h4>
                                    <p>Professional writers with over 15+ years of experience.</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="tp_work_box tp_work_box_blue" style="background: none;">
                                    <h1 data-toggle="counterUp" class="achievnum">150</h1>
                        <h4>+Industries Domains</h4>
                        <p>Our professional international resume writers have served to clients from more than 15 Countires </p>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="tp_work_box tp_work_box_blue" style="background: none;">
                                  <h1 data-toggle="counterUp" class="achievnum">20238</h1>
                        <h4>+ Resumes</h4>
                        <p>Our professional writers have served more than 20238 (& still counting) Resumes. </p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="tp_work_box tp_work_box_green" style="background: none;">
                                  <h1 data-toggle="counterUp" class="achievnum">15</h1>
                                  
                        <h4>+Countires</h4>
<p>Our professional international resume writers have served to clients from more than 15 Countires </p>
                                </div>
                            </div>

                      
                </div>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://www.markuptag.com/bootstrap/5/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // jQuery counterUp
        $('[data-toggle="counterUp"]').counterUp({
            delay: 15,
            time: 1500
        });
    </script>
        <!--===Top Selling Section End===-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.home_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newway\resources\views/frontend/home/home.blade.php ENDPATH**/ ?>