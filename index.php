<?php 
include "db_connect.php"; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Import Export Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>


<body data-spy="scroll" data-target="#navbarCollapse" data-offset="90">
    <?php include "header.php" ?>


    <!-- Header Start -->
<section id="hero">
    <div class="jumbotron jumbotron-fluid hero-section">
        <div class="container hero-content">
            <h1>Safe & Faster</h1>
            <h2 class="text-white display-3">Global Logistics, Accelerated by Intelligence</h2>
            <h4 class="text-white mb-5">Experience seamless end-to-end shipping...</h4>
            
            <div id="track" class="mx-auto" style="max-width: 600px;">
              <form action="track_result.php" method="GET">
                <div class="input-group">
                    <input type="text" name="tracking_id" class="form-control" placeholder="Tracking Id" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-quote">Track & Trace</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
        </div>
    </div>
</section>
    <!-- Header End -->


    <!-- About Start -->
<section id="about" class="about-section">
    <div class="container">
        
        <div class="section-header">
            <h6 class="section-subtitle text-uppercase">About Us</h6>
            <h1 class="section-title">What We Stand For</h1>
        </div>

        <div class="row">

            <!-- 01 -->
            <div class="col-md-4">
                <div class="about-box">
                    <h5 class="text-uppercase"><span>01.</span> History</h5>
                    <p>We are a global logistics provider delivering reliable transport solutions across industries.</p>
                    <div class="text-center">
                       <button class="btn btn-quote">READ NEWS</button>
                    </div>
                </div>
            </div>

            <!-- 02 -->
            <div class="col-md-4">
                <div class="about-box">
                    <h5 class="text-uppercase"><span>02.</span> Mission</h5>
                    <p>Our mission is to provide safe, fast, and cost-effective logistics services to our clients.</p>
                    <div class="text-center">
                       <button class="btn btn-quote">MORE INFO</button>
                    </div>
                </div>
            </div>

            <!-- 03 -->
            <div class="col-md-4">
                <div class="about-box">
                    <h5 class="text-uppercase"><span>03.</span> Vision</h5>
                    <p>We aim to become a global leader in smart logistics and sustainable supply chain innovation.</p>
                    <div class="text-center">
                       <button class="btn btn-quote">OUR GALLERY</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
    <!-- About End -->

    <!--quote -->
    <section id="quote" class="quote-section">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-6">
        <div class="quote-left">
          <h6 class="section-subtitle">Get A Quote</h6>
          <h2 class="section-title">Request A Free Quote</h2>

          <div class="timeline">
            <div class="timeline-item">
              <h3 class="counter" data-target="2010">0</h3>
              <p>Started Business</p>
            </div>
            <div class="timeline-item">
              <h3 class="counter" data-target="2015">0</h3>
              <p>Expanded Globally</p>
            </div>
            <div class="timeline-item">
              <h3 class="counter" data-target="2020">0</h3>
              <p>1000+ Shipments</p>
            </div>
            <div class="timeline-item">
              <h3 class="counter" data-target="2025">0</h3>
              <p>AI Logistics</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6" id="sendquote">
        <div class="quote-form">
            <form action="Insert_quoteform.php" method="post" id="sendquoteform" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
                <p id="message" class="text-dark" > </p>

              <!-- 2 column inputs -->
              <div class="col-md-6" >
                <label for="Departure-field" class="pb-2"></label>
                <input type="text" class="form-control" name = "departure" id="Departure-field" required="" placeholder="Departure City">
                <span class="error" id="Departure_error"></span>
              </div>

              <div class="col-md-6">
                <label for="Delivery-field" class="pb-2"></label>
                <input type="text" class="form-control" name="delivery" id="Delivery-field" required="" placeholder="Delivery City">
                <span class="error" id="delivery_error"></span>
              </div>

              <div class="col-md-6">
                <label for="weight-field" class="pb-2"></label>
                <input type="text" class="form-control" name="weight" id="weight-field" placeholder="Total Weight (kg)">
                <span class="error" id="weight_error"></span>

              </div>

              <div class="col-md-6">
                <label for="Dimension-field" class="pb-2"></label>
                <input type="text" class="form-control" name="dimension" id="Dimension-field" placeholder="Dimension (cm)">
                <span class="error" id="dimension_error"></span>
              </div>

              <div class="col-12">
                <label for="name-field" class="pb-2"></label>
                <input type="text" class="form-control" name="name" id="name-field" placeholder="Your Name">
                <span class="error" id="delivery_error"></span>
              </div>

              <div class="col-12">
                <label for="mail-field" class="pb-2"></label>
                <input type="email" class="form-control" name="email" id="mail-field" placeholder="Your Email">
                <span class="error" id="mail_error"></span>
              </div>

              <div class="col-12">
                <label for="phoneno-field" class="pb-2"></label>
                <input type="text" class="form-control" name="phonono" id="phoneno-field" placeholder="Phone Number">
                <span class="error" id="phoneno_error"></span>
              </div>

              <div class="col-12">
                <label for="message-field" class="pb-2"></label>
                <textarea class="form-control" rows="4" name="message" id="message-field" placeholder="Message"></textarea>
                <span class="error" id="message_error"></span>
              </div>

              <div class="col-12 text-center">
                <button class="btn btn-quote" type="button" id="submit_quote">Get A Quote</button>
              </div>

            </div>
          </form>

        </div>
      </div> <!-- end form-->

    </div>
  </div>
</section><br><br>



    <!-- service start -->

    <section id="service" class="services-section">
  <div class="container">

    <div class="section-header">
            <h6 class="section-subtitle text-uppercase">Services</h6>
            <h1 class="section-title">What We Can Do For You</h1>
        </div>

    <div class="row">

      <div class="col-md-3">
        <div class="service-card active">
          <i class="fa fa-cube"></i>
          <h4>About Our Company</h4>
          <p>We are a premier logistics provider dedicated to moving the world’s commerce with precision, speed, and integrity. With decades of industry experience, our mission is to simplify global trade by offering innovative, data-driven transport solutions that empower businesses to scale across borders without the complexity of traditional shipping.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-plane"></i>
          <h4>Air Freight</h4>
          <p>Our air freight services are designed for time-sensitive cargo that requires the highest level of security and rapid delivery. We connect your business to major global hubs, providing real-time tracking and specialized handling for perishables, electronics, and high-value goods to ensure they reach their destination on schedule.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-ship"></i>
          <h4>Sea Freight</h4>
          <p>For large-scale shipments and bulk commodities, our sea freight solutions offer the perfect balance between cost and capacity. Whether you need Full Container Load (FCL) or Less-than-Container Load (LCL) options, we manage the entire maritime process—from port-to-port logistics to complex customs documentation across all major international shipping lanes.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-truck"></i>
          <h4>Ground Cargo</h4>
          <p>Our ground cargo network provides the essential "last mile" connectivity your business needs to stay agile. With a versatile fleet of trucks and optimized routing, we offer seamless door-to-door delivery, regional distribution, and cross-border trucking. We ensure your goods move safely across the road, keeping your local and national supply chains running smoothly.</p>
        </div>
      </div>

    </div> <br>

    <div class="row">

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-box"></i>
          <h4>Packaging Solutions</h4>
          <p>We provide specialized industrial packaging and crating services designed to withstand the rigors of international transit. From temperature-controlled wraps for perishables to custom-built wooden crates for heavy machinery, our expert packing ensures your cargo remains damage-free and compliant with all global shipping standards.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-network-wired"></i>
          <h4>Supplychain Managemnent</h4>
          <p>Our end-to-end supply chain solutions go beyond simple transport by optimizing every touchpoint from procurement to final delivery. We leverage real-time data and advanced analytics to reduce lead times, minimize overhead costs, and build a resilient logistics network that can adapt to any market fluctuation or global challenge.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-warehouse"></i>
          <h4>Warehouse Services</h4>
          <p>Our modern, secure warehousing facilities offer flexible storage options including climate control, hazardous material handling, and cross-docking services. With our integrated Warehouse Management System (WMS), you get total visibility into your inventory levels, ensuring faster order fulfillment and seamless distribution across regional and global markets.</p>
        </div>
      </div>

      <div class="col-md-3">
        <div class="service-card">
          <i class="fa fa-project-diagram"></i>
          <h4>Project Logistics</h4>
          <p>When your cargo is oversized, overweight, or requires unique handling, our project logistics team steps in to manage the most complex moves. From infrastructure components to massive industrial equipment, we provide site surveys, specialized heavy-lift equipment, and meticulous route planning to ensure your high-stakes shipments arrive safely and on time.</p>
        </div>
      </div>

    </div>

  </div>
</section> 

<!-- /services section -->

<!--product -->
<section id="products" class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h6 class="section-subtitle text-uppercase">Our Catalog</h6>
            <h1 class="section-title">Export Excellence</h1>
        </div>

        <div class="row">
            <?php
            $cat_query = mysqli_query($conn, "SELECT product_category, MIN(product_image) as display_img FROM tbl_products GROUP BY product_category");
            
            if(mysqli_num_rows($cat_query) > 0) {
                while($cat = mysqli_fetch_assoc($cat_query)) {
                    $cat_name = $cat['product_category'];
                    $image = $cat['display_img'];
                    
                    $img_path = (!empty($image)) ? "img/products/".$image : "img/shawl.jpg";
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 text-center h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="<?php echo $img_path; ?>" class="card-img-top" style="height: 250px; object-fit: cover; transition: transform .5s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold text-uppercase" style="letter-spacing: 1px;"><?php echo $cat_name; ?></h4>
                            <p class="text-muted small">Premium global export solutions for <?php echo strtolower($cat_name); ?>.</p>
                            <hr style="width: 40px; border-top: 2px solid #ffd700; margin: 15px auto;">
                            <a href="products.php?cat=<?php echo urlencode($cat_name); ?>" class="btn btn-quote px-4">Browse Catalog</a>
                        </div>
                    </div>
                </div>
            <?php 
                } 
            } else {
                echo '<div class="col-12 text-center"><p class="text-muted">No categories found. Add products in Admin to see them here.</p></div>';
            }
            ?>
        </div>
    </div>
</section>
    <!--/product -->
<!-- team -->
<section id="team" class="team-section">
  <div class="container">

    <!-- Heading -->
    <div class="section-header">
      <h6 class="section-subtitle">Our Team</h6>
      <h2 class="section-title">Meet Our Experts</h2>
    </div>

    <div class="row">

      <!-- Member 1 -->
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <img src="img/team1.jpg" alt="">
          <div class="team-info">
            <h5>John Doe</h5>
            <p>Operations Manager</p>
          </div>
        </div>
      </div>

      <!-- Member 2 -->
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <img src="img/team2.jpg" alt="">
          <div class="team-info">
            <h5>Sarah Smith</h5>
            <p>Logistics Head</p>
          </div>
        </div>
      </div>

      <!-- Member 3 -->
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <img src="img/team3.jpg" alt="">
          <div class="team-info">
            <h5>Elena Rodriguez</h5>
            <p>Warehouse Manager</p>
          </div>
        </div>
      </div>

      <!-- Member 4 -->
      <div class="col-lg-3 col-md-6">
        <div class="team-card">
          <img src="img/team7.jpg" alt="">
          <div class="team-info">
            <h5>David Kumar</h5>
            <p>Transport Manager</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!--team end -->




    <!-- Testimonial Start -->
<section class="testimonial-section">
  <div class="container text-center">
    <div class="section-header">
            <h6 class="section-subtitle text-uppercase">Testimonals</h6>
            <h1 class="section-title">What Out Clients say</h1>
        </div>

    <div class="testimonial-slider">

      <!-- LEFT ARROW -->
      <button class="nav-btn prev">&#10094;</button>

      <!-- CONTENT -->
      <div class="testimonial-content active">
        <img src="img/testimonial-1.jpg" class="testimonial-img">
        <h5>Marcus Thorne, Operations Director at Global Retail Corp</h5>
        <p>
          “Switching our primary freight forwarding to this team was the best move we made this year. Their real-time tracking is remarkably accurate, and we’ve seen a 15% reduction in shipping delays across our international routes. They don’t just move cargo; they solve problems.”
        </p>
      </div>

      <div class="testimonial-content">
        <img src="img/testimonial-2.jpg" class="testimonial-img">
        <h5>Julian Vance, Founder of Artisan Goods Co.</h5>
        <p>
          “As a small business, I was terrified of scaling and losing control over my deliveries. Their fulfillment services are seamless. My customers are thrilled with the speed of delivery, and the integration with my Shopify store was painless. Truly a partner in my growth.”
        </p>
      </div>

      <div class="testimonial-content">
        <img src="img/testimonial-3.jpg" class="testimonial-img">
        <h5>David Chen, Logistics Manager for Urban Eats</h5>
        <p>
          “In the world of time-sensitive deliveries, every minute counts. This team consistently hits their windows and handles our high-volume local routes with professionalism. Their drivers are courteous, and the proof-of-delivery system is top-tier.”
        </p>
      </div>

      <!-- RIGHT ARROW -->
      <button class="nav-btn next">&#10095;</button>

    </div>

  </div>
</section>   
 <!-- Testimonial End -->

<!-- contact -->
<section id="contact" class="contact-section">
  <div class="container">

    <div class="section-header">
      <h6 class="section-subtitle">Contact Us</h6>
      <h2 class="section-title">Get In Touch With Us</h2>
    </div>

    <div class="row">

      <!-- LEFT INFO -->
      <div class="col-lg-5 mb-4">
         <div class="contact-card">

          <h5>Contact Information</h5>
          <p>Feel free to reach out for any logistics support or inquiries.</p>

         <div class="contact-item">
           <i class="fa fa-map-marker-alt"></i>
         <div>
        <h6>Location</h6>
        <p>1'st Floor, No.29 Natarajar Street, Balaji Nagar, Thiruparankundram, Madurai, Tamil Nadu, 625005.<br>

46-3 Petaling Utama Avenue, Jalan PJS 1/50 Taman Petaling Utama 46150 Petaling Jaya Selangor Malaysia</p>
      </div>
    </div>

    <div class="contact-item">
      <i class="fa fa-phone-alt"></i>
      <div>
        <h6>Phone</h6>
        <p>7395801994</p>
      </div>
    </div>

    <div class="contact-item">
      <i class="fa fa-envelope"></i>
      <div>
        <h6>Email</h6>
        <p>info@shadowws.com</p>
      </div>
    </div>

  </div>
</div>
      <!-- RIGHT FORM -->
     <div class="col-lg-7" id="sendcontact">
    <form class="contact-form" action="Insert_quoteform.php" id="sendcontactform" method="post" data-aos="fade-up" data-aos-delay="200">
        <p id="contact_message" class="text-dark"></p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="contact-name" >Name</label>
                <input type="text" name="name" id="contact-name" class="form-control" required>
                <span class="error" id="name_error"></span>
            </div>
            <div class="col-md-6 mb-3">
                <label for="contact-email">Email</label>
                <input type="email" name="email" id="contact-email" class="form-control" required>
                <span class="error" id="email_error"></span>
            </div>
        </div>
        <div class="mb-3">
            <label for="contact-subject">Subject</label>
            <input type="text" name="subject" id="contact-subject" class="form-control">
            <span class="error" id="subject_error"></span>
        </div>
        <div class="mb-3">
            <label for="contact-message-field">Message</label>
            <textarea name="message" id="contact-message-field" class="form-control" rows="5"></textarea>
            <span class="error" id="message_error"></span>
        </div>
        <button class="btn-contact" type="button" id="submit_contact" >Send Message</button>
    </form>
   </div>
</div>
  </div>
</section>

    <!-- Blog Start -->
<section id="blog" class="blog-section">
  <div class="container">

    <!-- HEADING -->
    <div class="section-header">
      <h6 class="section-subtitle">Our Blog</h6>
      <h2 class="section-title">Latest News & Articles</h2>
    </div>

    <div class="row">

      <!-- BLOG 1 -->
      <div class="col-md-6">
        <div class="blog-card">
          <img src="img/blog-1.jpg" alt="">

          <div class="blog-overlay">

            <!-- META INFO -->
            <div class="blog-meta">
              <span>Jan 01, 2026</span> | 
              <span>By Terasa Winston</span>
            </div>

            <!-- MAIN CONTENT -->
            <h5>Logistics Trends 2026</h5>
            <p>Discover the future of smart supply chain solutions.</p>

          </div>
        </div>
      </div>

      <!-- BLOG 2 -->
      <div class="col-md-6">
        <div class="blog-card">
          <img src="img/blog-2.jpg" alt="">

          <div class="blog-overlay">

            <div class="blog-meta">
              <span>Feb 10, 2026</span> | 
              <span>By Terasa Winston</span>
            </div>

            <h5>Warehouse Automation</h5>
            <p>How automation is changing logistics industry.</p>

          </div>
        </div>
      </div>

    </div>

  </div>
</section>
    <!-- Blog End -->


<?php include "footer.php" ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>