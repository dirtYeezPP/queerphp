<?php

// about files only. 
// class doesnt need to remember anything in between calls, hence not creating an object with new as the other repos. 

class ImageUploader{
    private const MIMES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];  
    private const EXTS = ['png', 'jpg', 'jpeg', 'gif', 'webp']; 
    private const ROOT = __DIR__ . '/../'; // go up to root 

    public static function save(?array $file): ?string {
        if(!$file || $file['error'] !== UPLOAD_ERR_OK) return null; 

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)); 
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']); 
        if(!in_array($mime, self::MIMES) || !in_array($ext, self::EXTS)) return null; 

        $path = 'posts/' . uniqid('pic_') . '.' . $ext; 
        return move_uploaded_file($file['tmp_name'], self::ROOT . $path) ? $path : null; 
    }

    public static function delete(?string $path): void {
        if($path && file_exists(self::ROOT . $path)) unlink(self::ROOT . $path); 
    }
}