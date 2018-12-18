<?php if (isset($sub)) {
    if (isset($data)) {
        $this->load->view($sub, $data);
    } else {
        $this->load->view($sub);
    }
} ?>