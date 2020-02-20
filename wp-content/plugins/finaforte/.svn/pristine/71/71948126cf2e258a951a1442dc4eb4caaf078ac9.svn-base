<?php
add_shortcode('fina_forte_mortgage', 'fina_forte_mortgage_shortcode');

// The callback function that will replace [shortcode]
function fina_forte_mortgage_shortcode() {

    ob_start();

    if (isset($_SESSION['finaforte']['basic_form']) && $_SESSION['finaforte']['basic_form'] == "1") {
        if (isset($_SESSION['finaforte']['send_email']) && $_SESSION['finaforte']['send_email'] == "1") {
            email_send_form();
        } else if (isset($_SESSION['finaforte']['view_totalcalculation']) && $_SESSION['finaforte']['view_totalcalculation'] == "1") {
            total_calculation_form();
        } else {
            start_calculation_form();
        }
    } else {
        mortgage_basic_form();
    }

    return ob_get_clean();
}