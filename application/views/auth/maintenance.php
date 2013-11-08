<?php
    /*
     * HTML for the Login Page
     */

    $data = array();
    // A unique identifier for this page (used for CSS styling)
    $data['body_ID'] = "maintenance-page";
    // Text that should be placed in the title tag in the head
    $data['page_title'] = "Site is down";
    /*
     *  Add addition CSS stylesheets here!
     *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SYTLESHEETS');
     */
    $data['header_CSS_inc'] = array();
    /*
     *  Add addition CSS stylesheets here!
     *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SCRIPTS');
     */
    $data['header_JS_inc'] = array();
    // Set this to true if you wish to display the nav bar.
    $data['header_nav_display'] = False;

    // Load the header file!
    $this->load->view('common/header', $data);
?>
<div id="maintenancemessage"><h1><?php echo config_item('maintenance_message') ?></h1></div>
<?php $this->load->view('common/footer'); ?>