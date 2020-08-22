<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasImage
{
    /**
     * Get upload directory
     *
     * @return string
     */
    abstract public function getUploadDirectory() : string;

    /**
     * Model image attribute name
     *
     * @return string
     */
    abstract public function getImageAttributeName() : string;

    protected static function bootHasImage()
    {
        static::deleted(function (Model $model) {
            $model->deleteImageOnDeleted();
        });
    }

    /**
     * Delete image on model deleted
     */
    protected function deleteImageOnDeleted()
    {
        $this->deleteImage();
    }

    /**
     * Delete model image
     */
    public function deleteImage()
    {
        $attribute = $this->getImageAttributeName();
        $image = $this->getAttribute($attribute);
        $imageDirectory = $this->getUploadDirectory();
        Storage::disk('public')->delete($imageDirectory . $image);
        $this->setAttribute($attribute, null);
        $this->save();
    }

    /**
     * Save model image
     *
     * @param UploadedFile $image
     */
    public function saveImage(UploadedFile $image)
    {
        $attribute = $this->getImageAttributeName();
        $imageDirectory = $this->getUploadDirectory();
        $filename = $image->getClientOriginalName() . Str::random() . '.' . $image->getClientOriginalExtension();
        $currentImage = $this->getAttribute($attribute);
        if ($currentImage)
            $this->deleteImage();
        Storage::disk('public')->put($imageDirectory . $filename, File::get($image));
        $this->setAttribute($attribute, $filename);
        $this->save();
    }

    /**
     * Get image link
     *
     * @return string
     */
    public function getImageLink()
    {
        $attribute = $this->getImageAttributeName();
        $imageDirectory = $this->getUploadDirectory();
        $image = $this->getAttribute($attribute);

        return asset('storage/' . $imageDirectory . $image);
    }

    /**
     * Check if user has image
     *
     * @return bool
     */
    public function hasImage() : bool
    {
        $attribute = $this->getImageAttributeName();
        $imageDirectory = $this->getUploadDirectory();
        $image = $this->getAttribute($attribute);

        return $image and Storage::disk('public')->exists($imageDirectory . $image);
    }
}
