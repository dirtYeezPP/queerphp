<?php 

class PoemRepository {
    public function __construct(private PDO $pdo){} 

    public function all(): array {
        $sql = "SELECT p.*, u.pseudonym, u.username
            FROM poems p LEFT JOIN users u ON p.createdById = u.userId"; 
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function byUser(int $userId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM poems WHERE createdById = ?"); 
        $stmt->execute([$userId]); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function findOwned(int $id, int $userId): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM poems WHERE id = ? AND createdById = ?");
        $stmt->execute([$id, $userId]); 
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; 
    }

    public function create(array $data): void {
        $sql = "INSERT INTO poems (title, genre, poem, pImg, published, createdById)
            VALUES (:title, :genre, :poem, :pImg, :published, :createdById)"; 
        $this->pdo->prepare($sql)->execute($data); 
    }

    public function update(int $id, int $userId, array $fields): void {
        // throw away any key thats not in this list 
        $allowed = ['title', 'genre', 'poem', 'pImg']; 
        $fields = array_intersect_key($fields, array_flip($allowed)); 
        if (!$fields) return; 

        $set = implode(', ', array_map(fn($f)=>"$f = :$f", array_keys($fields))); 
        $sql = "UPDATE poems SET $set WHERE id = :id AND createdById = :createdById"; 
        $this->pdo->prepare($sql)->execute($fields + ['id'=>$id,, 'createdById'=>$userId]); 
    }

    public function delete(int $id, int $userId): void {
        $this->pdo->prepare("DELETE FROM poems WHERE id = ? AND createdById = ?")
            ->execute([$id, $userId]); 
    }
}