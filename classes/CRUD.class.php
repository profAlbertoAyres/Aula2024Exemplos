<?php

abstract class CRUD{
    protected $table;
    abstract function add();
    abstract function update($field, $id);

    public function all(){
        $sql = "SELECT * FROM $this->table";
        $stmt = Database::prepare($sql);

        // Executar a consulta e verificar se funcionou
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    # Buscar em registro
    public function search(string $campo, int $id) {
        $sql = "SELECT * FROM $this->table WHERE $campo = :id";
        $stmt = Database::prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dados = $stmt->fetch(PDO::FETCH_OBJ);
            return $dados;
        }else{
            return null;
        }
    }

    // Método para excluir um registro pelo ID
    public function delete($campo, int $id): bool {
        $query = "DELETE FROM $this->table WHERE $campo = :id";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir registro: " . $e->getMessage();
            return false;
        }
    }
}