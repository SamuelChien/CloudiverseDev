<?php
    $data['bodyID'] = "home-page";
    $data['pageTitle'] = "Welcome";
    $data['showNavBar'] = True;
    $this->load->view('common/header', $data);
?>
        <section id="main-body">
        </section>
<?php $this->load->view('common/footer'); ?>