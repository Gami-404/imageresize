<?php
/**
 * Created by PhpStorm.
 * User: gami
 * Date: 21/08/16
 * Time: 03:15 م
 */

namespace Image;


use Mockery\CountValidator\Exception;

/**
 * Class Image
 * @package Plugin\Image
 */
class Image
{
    /**
     *  All versions in image
     * @var array
     */
    protected $versions = [];
    /**
     * default quality
     * @var int
     */
    protected $defaultQuality = 75;
    /**
     * default Path for image for myproject/public/
     * @var string
     */
    protected $defaultPath = '/image/';

    /**
     * Image constructor.
     */
    public function __construct($versions)
    {
        $this->versions = $versions;
    }

    /**
     * add runtime versions
     * @param $version
     */
    public function addVersion($version)
    {
        $this->versions[] = $version;
    }

    /**
     * Make all version allowed for image
     * @param $originalPath
     */
    public function makeAllVersions($originalPath)
    {
        foreach ($this->versions as $versionName => $versionAttribute) {
            $this->makeVersion($versionName, $originalPath);
        }
    }

    /**
     * Make version which his name $versionName and in path
     * @param $versionName
     * @param $originalPath
     */
    public function makeVersion($versionName, $originalPath)
    {
        $version = '';
        try {
            $version = $this->versions[$versionName];
        } catch (\Throwable $ex) {
            throw new Exception('version not found');
        }
        $newPath = public_path((isset($version['path']) ? $version['path'] : $this->defaultPath) .
            $version['suffix'] . '-' . pathinfo($originalPath, PATHINFO_BASENAME));
        $quality = (isset($version['quality']) ? $version['quality'] : $this->defaultQuality);
        $this->createImageResized($originalPath, $newPath, $version['height'], $version['width'], $quality);
    }

    /**
     * create image
     * @param $originalImagePath
     * @param $versionPath
     * @param $height
     * @param $width
     * @param null $quality
     */
    private function createImageResized($originalImagePath, $versionPath, $height, $width, $quality = null)
    {
        list($originalWidth, $originalHeight) = getimagesize($originalImagePath);
        $ratio = $originalWidth / $originalHeight;
        if (($width / $height) > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width * $ratio;
        }
        $img = "";
        $ext = pathinfo($originalImagePath, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'gif':
            case'GIF':
                $img = imagecreatefromgif($originalImagePath);
                break;
            case 'png':
            case 'PNG':
                $img = imagecreatefrompng($originalImagePath);
                break;
            default:
                $img = imagecreatefromjpeg($originalImagePath);
        }
        $tci = imagecreatetruecolor($width, $height);
        imagecopyresampled($tci, $img, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
        imagejpeg($tci, $versionPath, $quality);
    }

    /**
     * return the suffix of version
     * @param $versionName
     * @return mixed
     */
    public function suffix($versionName)
    {
        return $this->versions[$versionName]['suffix'];
    }

}