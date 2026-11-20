<?php 

class UserRepository{
    public function __construct(private PDO $pdo) {}

    public function findByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?"); 
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; 
    }

    public function emailExists(string $email): bool {
        //count returns a single digit, fetchcolumn reads that number. 
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?"); 
        $stmt->execute([$email]); 
        return $stmt->fetchColumn() > 0; 
    }

    public function create(array $data): void {
        $sql = "INSERT INTO users (username, pseudonym, email, hashedPassword)
            VALUES (:username, :pseudonym, :email, :hashedPassword)"; 
        $this->pdo->prepare($sql)->execute([
            'username' => $username, 
            'pseudonym' => $pseudonym, 
            'email' => $email, 
            'hashedPassword' => password_hash($password, PASSWORD_DEFAULT),
        ]); 
    }

    public function checkLogin(string $email, string $password): ?array {
        $user = $this->findByEmail($email); 
        if($user && password_verify($password, $user['hashedPassword'])) {
            return $user;
        }
        return null; 
    }
}