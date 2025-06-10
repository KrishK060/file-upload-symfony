<?php
namespace App\Service;

use Doctrine\Bundle\DoctrineCacheBundle\DependencyInjection\Definition\FileSystemDefinition;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper{

    const ARTICLE_IMAGE = 'uploads';

    private $filesystem;

    public function __construct(FilesystemInterface $filesystem){
        $this->filesystem = $filesystem;
    }

    public function uploadArticleImage(UploadedFile $uploadedFile):string{
        $destination = $this->filesystem.'/'.self::ARTICLE_IMAGE;

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = $originalFilename . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move($destination, $newFilename);
        
        return $newFilename;
    }
}