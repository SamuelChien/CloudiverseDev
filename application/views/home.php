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
        <div class="row padding-top">
          <div class="medium-4 columns">
            <div class="progress-bar" id="progress-bar-1"><div class="status"></div></div>
          </div>
          <div class="medium-4 columns">
            <div class="progress-bar" id="progress-bar-2"><div class="status"></div></div>
          </div>
          <div class="medium-4 columns">
            <div class="progress-bar" id="progress-bar-3"><div class="status"></div></div>
          </div>
          <script>
            //A tempoarary script that animates the prgress bar above.
            var bar1 = $("#progress-bar-1");
            var bar2 = $("#progress-bar-2");
            var bar3 = $("#progress-bar-3");
            setProgressBar(1, bar1, function(){
              setProgressBar(1, bar2, function(){
                setProgressBar(1, bar3);
              });
            });
          </script>
        </div>
      </div>
    </section>
    <!-- At the bottom of your page but inside of the body tag -->
    <ol class="joyride-list" data-joyride>
      <li data-button="Sure">
        <h4>Welcome to Cloudiverse</h4>
        <p>Since this is your first time using the service, would you like to have a tour of the site?</p>
      </li>
      <li data-id="desktop-nav" data-text="Next">
        <h4>The Navigational Bar</h4>
        <p>You can control all the details for you tour stop. Any valid HTML will work inside of Joyride.</p>
      </li>
      <li data-id="joyride-stop-settings" data-button="Next" data-options="tip_animation:fade">
        <h4>Stop #2</h4>
        <p>You can change all your settings, including managing cloud storages over here!</p>
      </li>
      <li data-id="file-list" data-text="Next">
        <h4>File lists</h4>
        <p>All your file are shown here sdfhpj</p>
      </li>
      <li data-id="file-controls" data-text="Next">
        <h4>File manager</h4>
        <p>You can do stuff fdgldfsg here.</p>
      </li>
      <li data-button="Ok got it!">
        <h4>You're good to go!</h4>
        <p>If you have anymore questions visit our FAQs or our docs  blah blah blah</p>
      </li>
    </ol>
    <script>
      $(document).ready(function(){
        //$(this).foundation('joyride', 'start');
      });
    </script>
<?php
  $data['header_JS_inc'] = $header_JS_inc;
  $this->load->view('i/footer', $data);
?>