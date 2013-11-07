<?php
    $data = array();
    // A unique identifier for this page (used for CSS styling)
    $data['body_ID'] = "login-page";
    // Text that should be placed in the title tag in the head
    $data['page_title'] = "Login or Sign up";
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
        <section id="main-body">
            <!--The login window div-->
            <section id="login-window">
                <!--Foundation's javascript section-->
                <div data-section="" class="section-container auto font-title" style="min-height: 51px;" data-section-resized="true">
                    <section class="dropdown active">
                        <div data-section-title="" class="text-unselectable title"><a href="#panel1" class="text-unselectable"><span class="font-awesome mobile-tab-icon hide-for-medium-up"></span>Login</a></div>
                        <div data-section-content="" class="content">
                            <!--Login form-->
                            <form action="<?php echo base_url();?>" method="post" enctype="multipart/form-data">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <!--Login Username-->
                                    <div class="large-3 columns form-text">Username</div>
                                    <div class="large-9 columns">
                                        <div class="input-icon font-awesome">&#xf007;</div><input type="text" class="form-input" name="username">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Login Password-->
                                    <div class="large-3 columns form-text">Password</div>
                                    <div class="large-9 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Stay logged in checkbox-->
                                    <div class="form-checkbox">
                                        <input type="checkbox" id="keep-logged-in" name="keep-logged-in" />
                                        <label for="keep-logged-in"><span></span>Stay Logged in</label>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="row">
                                    <!--Submit-->
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="login">
                                </div>
                            </form>
                            <div class="seperator"></div>
                            <!--Link to forgot your password/username page-->
                            <p><a href="#"><u>Forgot</u> your username/password?</a></p>
                        </div>
                    </section>
                    <section class="dropdown">
                        <div data-section-title="" class="text-unselectable title" style="left: 89px;"><a href="#panel2" class="text-unselectable"><span class="font-awesome mobile-tab-icon hide-for-medium-up"></span>Sign Up</a></div>
                        <div data-section-content="" class="content">
                            <!--Registration form-->
                            <form action="register" method="post" enctype="multipart/form-data">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <!--New Username-->
                                    <div class="large-4 columns form-text">New Username</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf007;</div><input type="text" class="form-input" name="username">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--New email-->
                                    <div class="large-4 columns form-text">Email</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf003;</div><input type="email" class="form-input" name="email">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--New Passwrord-->
                                    <div class="large-4 columns form-text">New Password</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password"> 
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Reconfirm new password-->
                                    <div class="large-4 columns form-text">Re-enter Password</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password-confirm">
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Terms & conditions check box-->
                                    <div class="form-checkbox">
                                        <input type="checkbox" id="terms-conditions" name="terms-conditions" />
                                        <label for="terms-conditions"><span></span>I accept the <a href="#"><u>terms and condidtions</u></a></label>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="row">
                                    <!--Submit-->
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="Sign Up">
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </section>
            <!--Foundation's javascript includes-->
            <script>document.write("<script type='text/javascript' src=<?php echo base_url('asset/js/vendor'); ?>/"+ ("__proto__" in {} ? "zepto" : "jquery") + ".js><\/script>");</script>
            <script type="text/javascript" src="<?php echo base_url('asset/js/foundation/foundation.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('asset/js/foundation/foundation.section.js'); ?>"></script>
            <script>$(document).foundation();</script>
        </section>
<?php $this->load->view('common/footer'); ?>