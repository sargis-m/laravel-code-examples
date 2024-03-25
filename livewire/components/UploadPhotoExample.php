<?php

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPhotoExample extends Component
{
    use WithFileUploads;

    public $photo;

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:2048'
        ]);

        // Store the uploaded file in the "photos" directory of the default filesystem disk.
        $this->photo->store('photos');

        // Store in the "photos" directory in a configured "s3" bucket.
        $this->photo->store('photos', 's3');

        // Store in the "photos" directory with the filename "avatar.png".
        $this->photo->storeAs('photos', 'avatar');

        // Store in the "photos" directory in a configured "s3" bucket with the filename "avatar.png".
        $this->photo->storeAs('photos', 'avatar', 's3');

        // Store in the "photos" directory, with "public" visibility in a configured "s3" bucket.
        $this->photo->storePublicly('photos', 's3');

        // Store in the "photos" directory, with the name "avatar.png", with "public" visibility in a configured "s3" bucket.
        $this->photo->storePubliclyAs('photos', 'avatar', 's3');
    }
}