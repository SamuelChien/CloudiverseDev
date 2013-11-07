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
            <div class="container row">
                <div class="large-2 medium-3 columns">
                    <section id="file-controls" 
                    <!--Code for uploading, deleating renaming.. of files goes here-->
                        <ul class="font-title text-center">
                            <li>Upload</li>
                            <li>New Folder</li>
                            <li>Delete</li>
                            <li>Rename</li>
                            <li>History</li>
                            <li id="addPDF">ADD PDF</li>
                            <li id="addWord">ADD WORD</li>
                            <li id="addFolder">ADD FOLDER</li>
                        </ul>
                    </section>
                </div>
                <div class="large-10 medium-9 columns">
                    <section id="file-list" 
                        <!--Code for the filemanager goes here-->
                        <ul id="sortable" class="font-title">	
                            <li class="ui-state-default">
                                <ul id="inline">
                                    <li id="pictures"><img class="image" src=""></li>
                                    <li id="name">Folder</li>
                                    <li id="time">Time</li>
                                </ul>
                            </li>
                            <li class="ui-state-default">
                                <ul id="inline">
                                    <li id="pictures"><img class="image" src=""></li>
                                    <li id="name">PDF</li>
                                    <li id="time">Time</li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </section>
<?php $this->load->view('common/footer'); ?>