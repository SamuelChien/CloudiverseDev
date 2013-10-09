<?php $this->load->view('i/header'); ?>
<form id="loginform" action="/login/" method="post" enctype="multipart/form-data">
    <?php
        if ($this->session->flashdata('status'))
        {
            $status = $this->session->flashdata('status');
            $message = $this->session->flashdata('message');
            echo "<div class='{$status}'><p>{$message}</p></div>";
        }
    ?>
    <h2>Enter your Credentials</h2>
    <input id="username" type="text" name="username" placeholder="Username">
    <input id="password" type="password" name="password" placeholder="Password">
    <button id="login" type="submit" name="login" value="login">Login</button>
</form>
<?php $this->load->view('i/footer'); ?>