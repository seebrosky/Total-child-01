<?php
//CALLS TOTAL'S DEFAULT CSS
function total_child_enqueue_parent_theme_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'total_child_enqueue_parent_theme_style' );

// ADDING THIS COMMENT TO TEST GIT

// Custom function to add text below logo
function custom_header_text() { ?>
    <div class="logo-title clr">front-end developer</div>
<?php }
add_action( 'wpex_hook_site_logo_inner', 'custom_header_text', 999 );

// ScrollTo JS FADES OUT TEXT AT TOP OF BROWSER
function sk_enqueue_scripts() {
    wp_enqueue_script( 'scrollTo', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.5-beta', true );
    wp_enqueue_script( 'home', get_stylesheet_directory_uri() . '/js/home.js', array( 'scrollTo' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );

// REMOVE QUERY STRINGS - excluding Google Fonts
function wpex_remove_script_version( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'script_loader_src', 'wpex_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'wpex_remove_script_version', 15, 1 );

// CURRENT YEAR SHORTCODE
function current_year() {
    $year = date('Y');
    return $year;
}
add_shortcode('year', 'current_year');

// YEARS OF WEB DEV EXPERIENCE
function years_experience() {
	$startYear = 2008;
	$currYear = date('Y');
	return $currYear - $startYear;
}

// YEARS OF EXPERIENCE SHORTCODE
function add_experience_shortcode() {
    add_shortcode('experience_years', 'years_experience');
}
add_action('init', 'add_experience_shortcode');

// EMPLOYMENT DURATION CALCULATOR
function calculate_date_difference($atts) {
    // Extracting shortcode attributes
    $atts = shortcode_atts(
        array(
            'start_date' => '',
            'end_date'   => '',
        ),
        $atts,
        'date_difference'
    );

    // Check if both start_date and end_date are provided
    if (empty($atts['start_date']) || empty($atts['end_date'])) {
        return 'Please provide both start date and end date.';
    }

    // Convert date strings to DateTime objects
    $startDate = new DateTime($atts['start_date']);
    $endDate = new DateTime($atts['end_date']);

    // Calculate the difference
    $interval = $startDate->diff($endDate);

    // Format the result
    $result = $interval->format('%y years, %m months');

    return $result;
}

// CALCULATE EMPLOYMENT DATE DIFFERENCE SHORTCODE
function add_date_difference_shortcode() {
    add_shortcode('date_difference', 'calculate_date_difference');
}
add_action('init', 'add_date_difference_shortcode');

// YEARS BETWEEN DATES CALCULATOR
function calculate_year_difference_shortcode($atts) {
    // Extracting shortcode attributes
    $atts = shortcode_atts(
        array(
            'year_began' => '',
        ),
        $atts,
        'year_difference'
    );

    // Current year
    $currYear = date('Y');

    // Convert the provided yearBegan to an integer
    $yearBegan = intval($atts['year_began']);

    // Check if yearBegan is not provided or not a valid integer
    if (empty($yearBegan)) {
        return 'Please provide a valid value for year_began.';
    }

    // Calculate the difference
    $difference = $currYear - $yearBegan;

    return $difference;
}

// ADD YEARS BETWEEN DATES SHORTCODE
function add_year_difference_shortcode() {
    add_shortcode('year_difference', 'calculate_year_difference_shortcode');
}
add_action('init', 'add_year_difference_shortcode');

?>