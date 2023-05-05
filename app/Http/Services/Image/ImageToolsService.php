<?php

namespace App\Http\Services\Image;

class ImageToolsService
{
    protected $image;
    protected $exclusiveDirectory;
    protected $imageDirectory;
    protected $imageName;
    protected $imageFormat;
    protected $finalImageDirectory;
    protected $finalImageName;

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    public function setExclusiveDirectory($exclusiveDirectory)
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, "/\\");
    }

    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = trim($imageDirectory, "/\\");
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    public function setCurrentImageName()
    {
        return !empty($this->image) ? $this->setImageName(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME)) : false;
    }

    public function getImageFormat()
    {
        return $this->imageFormat;
    }

    public function setImageFormat($imageFormat)
    {
        $this->imageFormat = $imageFormat;
    }

    public function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }

    public function setFinalImageDirectory($finalImageDirectory)
    {
        $this->finalImageDirectory = $finalImageDirectory;
    }

    public function getFinalImageName()
    {
        return $this->finalImageName;
    }

    public function setFinalImageName($finalImageName)
    {
        $this->finalImageName = $finalImageName;
    }

    protected function checkDirectory($imageDirectory)
    {
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0755, true);
        }
    }

    protected function provider()
    {
        // Set Properties
        $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
        $this->getImageName() ?? $this->setImageName(time());
        $this->getImageFormat() ?? $this->setImageFormat($this->image->extension());
        // Set Final Image Directory
        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getImageDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();
        $this->setFinalImageDirectory($finalImageDirectory);
        // Set Final Image Name
        $finalImageName = $this->getImageName() . '.' . $this->getImageFormat();
        $this->setFinalImageName($finalImageName);
        // Check And Create Final Image Directory
        $this->checkDirectory($this->getFinalImageDirectory());
    }

    public function getImageAddress()
    {
        return $this->finalImageDirectory . DIRECTORY_SEPARATOR . $this->finalImageName;
    }
}
