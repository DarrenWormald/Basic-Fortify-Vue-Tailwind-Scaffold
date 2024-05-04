<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Actions\Contracts\UpdatesUserProfilePhoto;

class UpdateUserProfilePhoto implements UpdatesUserProfilePhoto
{
    public function update(User $user, UploadedFile $file): void
    {
        
        //delete old profile photo
        if(Storage::disk('public')->exists($user['profile_photo_path'])){
            Storage::disk('public')->delete($user['profile_photo_path']);
        }

        $user->update([
            'profile_photo_path' => $file->storePublicly(
                'profile-photos',
                ['disk' => 'public']
            )
        ]);
    }
}