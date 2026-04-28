(function ($) {
    "use strict";
    
    // 1. Navbar Dropdown
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });

    // 2. Facts counter
    if ($('[data-toggle="counter-up"]').length) {
        $('[data-toggle="counter-up"]').counterUp({
            delay: 10,
            time: 2000
        });
    }

    // 3. Navbar Scroll Visibility
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.custom-navbar').addClass('scrolled');
        } else {
            $('.custom-navbar').removeClass('scrolled');
        }
    });

    // 4. Testimonials (Added safety check)
    let index = 0;
    const slides = document.querySelectorAll(".testimonial-content");
    if (slides.length > 0) {
        function showSlide(i) {
            slides.forEach(slide => slide.classList.remove("active"));
            slides[i].classList.add("active");
        }

        const nextBtn = document.querySelector(".next");
        const prevBtn = document.querySelector(".prev");

        if(nextBtn) nextBtn.onclick = function () {
            index = (index + 1) % slides.length;
            showSlide(index);
        };

        if(prevBtn) prevBtn.onclick = function () {
            index = (index - 1 + slides.length) % slides.length;
            showSlide(index);
        };
    }

    // 5. Get a Quote Year Run 
const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    counter.innerText = '0';

    const updateCounter = () => {
        // Use parseInt to ensure we get a clean number
        const target = parseInt(counter.getAttribute('data-target'));
        const current = parseInt(counter.innerText);

        // Adjust the speed (higher divisor = slower animation)
        const increment = Math.ceil(target / 100); 

        if (current < target) {
            counter.innerText = current + increment;
            setTimeout(updateCounter, 30);
        } else {
            counter.innerText = target;
        }
    };

    updateCounter();
});

    // 6. Quote Form & Constraints
    $(document).ready(function() {
        $(document).on('input', '#name-field, #Departure-field, #Delivery-field', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        $(document).on('input', '#weight-field, #Dimension-field, #phoneno-field', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(document).on('click', '#submit_quote', function(e) {
            e.preventDefault();
            
            $('.error').html('');
            $('#message').html('');

            var departure = $('#Departure-field').val().trim();
            var delivery  = $('#Delivery-field').val().trim();
            var weight    = $('#weight-field').val().trim();
            var dimension = $('#Dimension-field').val().trim();
            var name      = $('#name-field').val().trim();
            var email     = $('#mail-field').val().trim();
            var phone     = $('#phoneno-field').val().trim();
            var msg       = $('#message-field').val().trim();

            var errors = [];

            if(!departure || !delivery || !weight || !dimension || !name || !email || !phone || !msg) {
                $('#message').css('color', 'red').html("*All fields are mandatory");
                return false;
            }

            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if(!emailPattern.test(email)) {
                $('#mail_error').html("*Valid email required");
                errors.push("email");
            }

            if(phone.length !== 10) {
                $('#phoneno_error').html("*Must be 10 digits");
                errors.push("phone");
            }

            if(errors.length === 0) {
                $.ajax({
                    url: 'Insert_quoteform.php',
                    method: 'POST',
                    data: $('#sendquoteform').serialize(),
                    success: function(response) {
                        if(response.trim() == "success") {
                            $('#message').css('color', 'green').html("Success! Quote submitted.");
                            $('#sendquoteform')[0].reset();
                        } else {
                            $('#message').css('color', 'red').html(response);
                        }
                    }
                });
            }
        });
    });

    

// 7.contact form
$(document).on('input', '#contact-name, #contact-subject', function () {
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
});

$(document).on('click', '#submit_contact', function(e) {
    e.preventDefault();
    
    
    $('.error').html('');
    $('#contact_message').html('');

    var name = $('#contact-name').val().trim();
    var email = $('#contact-email').val().trim();
    var subject = $('#contact-subject').val().trim();
    var msg = $('#contact-message-field').val().trim();

    var hasError = false;

    
    if(!name || !email || !subject || !msg) {
        $('#contact_message').css('color', 'red').html("*All fields are mandatory");
        hasError = true;
    }

    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if(email && !emailPattern.test(email)) {
        $('#email_error').html("*Enter a valid email");
        hasError = true;
    }

    if(!hasError) {
        $.ajax({
            url: 'Insert_ContactForm.php', 
            method: 'POST',
            data: $('#sendcontactform').serialize(),
            success: function(response) {
                if(response.trim() == "success") {
                    $('#contact_message').css('color', 'green').html("Message sent! We will contact you soon.");
                    $('#sendcontactform')[0].reset();
                } else {
                    $('#contact_message').css('color', 'red').html(response);
                }
            }
        });
    }
});

})(jQuery);