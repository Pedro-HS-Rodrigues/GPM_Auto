<?php

class Cadastro_model extends CI_Model {
    public function store($user) {
        $user['senha'] = password_hash($user['senha'], PASSWORD_BCRYPT);
        
        // Verifica se o username já existe no banco de dados
        $this->db->where('username', $user['username']);
        $query = $this->db->get('usuario');
        if ($query->num_rows() > 0) {
            return false; // Username já existe
        }

        // Tenta inserir o novo usuário
        return $this->db->insert('usuario', $user);
    }
}
?>
