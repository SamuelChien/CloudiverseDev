<?php
    $data['bodyID'] = "login-page";
    $data['pageTitle'] = "Login/Register";
    $this->load->view('common/header', $data);
?>
        <section id="main-body">
            <section id="login-window">
                <div data-section="" class="section-container auto font-title" style="min-height: 51px;" data-section-resized="true">
                    <section class="dropdown active">
                        <div data-section-title="" class="title"><a href="#panel1">Login</a></div>
                        <div data-section-content="" class="content">
                            <form action="login" method="post" enctype="multipart/form-data">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <div class="large-4 columns form-text">Username</div>
                                    <input type="text" class="form-input large-8 columns" placeholder="who are you?">
                                </div>
                                </br>
                                <div class="row">
                                    <div class="large-4 columns form-text">Password</div>
                                    <input type="password" class="form-input large-8 columns" placeholder="to make sure it is really you..">
                                </div>
                                </br>
                                <div class="row">
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="Login">
                                </div>
                            </form>
                            <div class="seperator"></div>
                            <p>Login using a social network</p>
                        </div>
                    </section>
                    <section class="dropdown">
                        <div data-section-title="" class="title" style="left: 89px;"><a href="#panel2">Register</a></div>
                        <div data-section-content="" class="content">
                            <form action="register" method="post" enctype="multipart/form-data">
                                <p class="text-center" style="color:#747474;padding: 30px 0">>LOGO HERE<</p>
                                <div class="row">
                                    <div class="large-4 columns form-text">New Username</div>
                                    <input type="text" class="form-input large-8 columns" placeholder="a unique name to identify you">
                                </div>
                                </br>
                                <div class="row">
                                    <div class="large-4 columns form-text">Email</div>
                                    <input type="email" class="form-input large-8 columns" placeholder="whichever email you prefedasd">
                                </div>
                                </br>
                                <div class="row">
                                    <div class="large-4 columns form-text">New Password</div>
                                    <input type="password" class="form-input large-8 columns" placeholder="something you won't forget">
                                </div>
                                </br>
                                <div class="row">
                                    <div class="large-4 columns form-text">Re-enter Password</div>
                                    <input type="password" class="form-input large-8 columns" placeholder="to make sure you typed it correctly">
                                </div>
                                </br>
                                <div class="row">
                                    <input type="submit" class="form-submit large-3 large-centered columns" value="Register">
                                </div>
                            </form>
                            <div class="seperator"></div>
                            <p>Login using a social network</p>
                        </div>
                    </section>
                </div>
            </section>
            <!--Foundation's javascript includes-->
            <script>document.write("<script type='text/javascript' src=<?php echo base_url('asset/js/vendor'); ?>/"+ ("__proto__" in {} ? "zepto" : "jquery") + ".js><\/script>");</script>
            <script type="text/javascript" src="<?php echo base_url('asset/js/foundation.min.js'); ?>"></script>
            <script>$(document).foundation();</script>
        </section>
<?php $this->load->view('common/footer'); ?>