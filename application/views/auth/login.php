        <section id="main-body">
            <!--The login window div-->
            <section id="login-window">
                <!--Foundation's javascript section-->
                <div data-section="" class="section-container auto font-title" style="min-height: 51px;" data-section-resized="true">
                    <section class="dropdown active">
                        <div data-section-title="" class="text-unselectable title"><a href="#panel1" class="text-unselectable"><span class="font-awesome mobile-tab-icon hide-for-medium-up"></span>Login</a></div>
                        <div data-section-content="" class="content">
                            <!--Login form-->
                            <form method="post">
								<input name="formtype" type="hidden" value="login">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <!--Login Username-->
                                    <div class="large-3 columns form-text">Username</div>
                                    <div class="large-9 columns">
                                        <div class="input-icon font-awesome">&#xf007;</div><input type="text" class="form-input" name="username" required>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Login Password-->
                                    <div class="large-3 columns form-text">Password</div>
                                    <div class="large-9 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password" required>
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
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="Login" name="login">
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
                            <form method="post">
								<?php 
								if (isset ($_SESSION['error']))
								{
									echo $_SESSION['error'];
									unset($_SESSION['error']);
								}

								?>
								<input name="formtype" type="hidden" value="signup">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <!--New Username-->
                                    <div class="large-4 columns form-text">New Username</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf007;</div><input type="text" class="form-input" name="username" required>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--New email-->
                                    <div class="large-4 columns form-text">Email</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf003;</div><input type="email" class="form-input" name="email" pattern=".*@.*" required>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--New Passwrord-->
									
                                    <div class="large-4 columns form-text">New Password</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password" required> 
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Reconfirm new password-->
                                    <div class="large-4 columns form-text">Re-enter Password</div>
                                    <div class="large-8 columns">
                                        <div class="input-icon font-awesome">&#xf084;</div><input type="password" class="form-input" name="password-confirm" required>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <!--Terms & conditions check box-->
                                    <div class="form-checkbox">
                                        <input type="checkbox" id="terms-conditions" name="terms-conditions" required/>
                                        <label for="terms-conditions"><span></span>I accept the <a href="#"><u>terms and condidtions</u></a></label>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="row">
                                    <!--Submit-->
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="Sign Up" name="signup">
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
<?php $this->load->view('i/footer'); ?>