<?php

namespace App\Domain\BackOffice\Utilities;

use Illuminate\Http\UploadedFile;

class FileUpload
{
    /**
     * If the uploaded file name matches with the name of the file in the uploaded directory,
     * the methods overrides the current file with the new file.
     *
     * @param UploadedFile $uploadedFile
     * @param string       $path
     * @param bool         $assignNewName
     * @param string       $fileSystem
     *
     * @return string|null
     * @throws \Exception
     */
    public function handle(UploadedFile $uploadedFile, $path = 'uploads', $assignNewName = true, $fileSystem = 'app')
    {
        if ( $assignNewName ) {
            $extension = $uploadedFile->getClientOriginalExtension();
            $fileName  = sprintf('%s.%s', strtotime(now()), $extension);
        } else {
            $fileName = $uploadedFile->getClientOriginalName();
        }
        try {
            $uploadedFile->storeAs(
                $path,
                $fileName,
                $fileSystem
            );

            return $fileName;

        } catch ( \Exception $e ) {
            throw new \Exception($e);
        }
    }
}

