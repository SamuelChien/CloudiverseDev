    <section id="main-body">
      <div class="main-body-container">
        <div class="row padding-top padding-bottom">
          <div class="large-3 medium-4 columns">
            <section id="file-controls">
            <!--Code for uploading, deleating renaming.. of files goes here-->
              <ul class="font-interface">
                <li id="upload-button"><div class="icon font-awesome">&#xf0ee;</div>Upload</li>
                <li id="newF-button"><div class="icon font-awesome">&#xf07b;</div>Create Folder</li>
                <li id="shareF-button"><div class="icon font-awesome">&#xf0c0;</div>Share</li>
                <li id="history-button"><div class="icon font-awesome">&#xf017;</div>History</li>
              </ul>
            </section>
          </div>
          <div class="large-9 medium-8 columns">
            <section id="file-list">
              <div id="file-list-details" class="font-signika text-upper">
                <div class="name">Name</div>
                <div class="filetype">Type</div>
                <div class="date-modified">Date Modified</div>
              </div>
              <ul class="font-interface">
                <li class="type-file">
                  <div class="name">Document 1</div>
                  <div class="icon share-link">&#xf14c;</div>
                  <div class="icon delete-link">&#xf00d;</div>
                  <div class="icon info-link">&#xf129;</div>
                  <div class="filetype">File</div>
                  <div class="date-modified">2 days ago</div>
                </li>
                <li class="type-file">
                  <div class="name">asdawe</div>
                  <div class="icon share-link">&#xf14c;</div>
                  <div class="icon delete-link">&#xf00d;</div>
                  <div class="icon info-link">&#xf129;</div>
                  <div class="filetype">File</div>
                  <div class="date-modified">1 days ago</div>
                </li>
                <li class="type-folder">
                  <div class="name">Extras</div>
                  <div class="icon share-link">&#xf14c;</div>
                  <div class="icon delete-link">&#xf00d;</div>
                  <div class="icon info-link">&#xf129;</div>
                  <div class="filetype">Folder</div>
                  <div class="date-modified">## days ago</div>
                </li>
              </ul>
            </section>
          </div>
        </div>
        <div class="seperator dark no-margin"></div>
      </div>
<?php
  /*
   * This includes adds the site's tutorial. To enable the site's tutorial, you must add a get varaible
   * showtutorial in the url and set it to true.
   * e.g. url: "http://cloudiverse.com/?showtutorial=true" will display the tutorial.
   */
  if($this->input->get('showtutorial') == 'true')
    $this->load->view('tutorial');
?>
    </section>
<?php
  /*
   * We want to include the Javascript files once the entire page has been loaded,
   * So JS includes go into the footer.
   */
  $data['header_JS_inc'] = $header_JS_inc;
  $this->load->view('i/footer', $data);
?>