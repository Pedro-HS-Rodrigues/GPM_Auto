<?php

class Cadastro_model extends CI_Model {
    public function store($user) {
        $user['senha'] = password_hash($user['senha'], PASSWORD_BCRYPT);
        $this->db->insert("usuario", $user);
    }
}
?>
