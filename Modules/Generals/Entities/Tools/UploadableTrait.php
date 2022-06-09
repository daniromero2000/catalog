<?php

namespace Modules\Generals\Entities\Tools;

use Illuminate\Http\UploadedFile;

trait UploadableTrait
{
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : str_random(25);

        return $file->storeAs(
            $folder,
            $name . "." . $file->getClientOriginalExtension(),
            $disk
        );
    }

    public function storeFile(UploadedFile $file, $folder = 'finances', $disk = 'public')
    {
        return $file->store($folder, ['disk' => $disk]);
    }
}
