jQuery(window).load(function() {
    jQuery('#fs_slider .flexslider').flexslider({
           animation: 'slide',
            slideshowSpeed: 9000,
            animationSpeed: 900,
            pauseOnAction: true,
            pauseOnHover: true,
            controlNav: false,
            directionNav: true, 
            controlsContainer: ".flexslider",
    });

    //const currentTheme = localStorage.getItem('theme') || 'light';
    //jQuery('html').attr('data-theme', currentTheme);

    jQuery('#theme-icon').attr(
        'class', 
        currentTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun'
    );

    // Handle the button click event to toggle the theme
    jQuery('#theme-icon').on('click', function () {
        let newTheme = $('html').attr('data-theme') === 'light' ? 'dark' : 'light';

        // Apply the new theme
        $('html').attr('data-theme', newTheme );

        // Save the user's preference in localStorage
        localStorage.setItem('theme', newTheme );
        jQuery(this).attr('class', newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun');
    });
});