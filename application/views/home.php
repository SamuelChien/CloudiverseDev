<?php
    $data = array();
    // A unique identifier for this page (used for CSS styling)
    $data['body_ID'] = "home-page";
    // Text that should be placed in the title tag in the head
    $data['page_title'] = "Welcome";
    /*
     *  Add addition CSS stylesheets here!
     *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SYTLESHEETS');
     */
    $data['header_CSS_inc'] = array();
    /*
     *  Add addition CSS stylesheets here!
     *  eg. $data['header_CSS_inc'] = array('LIST_OF_URLS_TO_SCRIPTS');
     */
    $data['header_JS_inc'] = array(
        'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
        base_url('asset/js/file-repo.js')
    );
    // Set this to true if you wish to display the nav bar.
    $data['header_nav_display'] = True;

    // Load the header file!
    $this->load->view('common/header', $data);
?>
        <section id="main-body">
            <div class="container">
                <section id="file-list">
                <!--Code for the filemanager goes here-->
<?php $this->load->view('file-repo/file'); ?>
                </section>
            </div>
        </section>
<?php $this->load->view('common/footer'); ?>