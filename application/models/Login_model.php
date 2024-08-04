<?php

class Login_model extends CI_Model {
    public function store($user, $password) {
        $this->db->where("username", $user);
        $usuario = $this->db->get("usuario")->row_array();
        // Verifica se o usuário foi encontrado
        if ($usuario && password_verify($password, $usuario['senha'])) {
            return $usuario;
        } else {
            return null;
        }
    }
}
?>
