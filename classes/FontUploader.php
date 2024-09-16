<?php

namespace App;

class FontUploader
{
    private $targetDir = "fonts/";
    public function getUploadedFonts() {
        $fonts = array_diff(scandir($this->targetDir), array('.', '..'));
        $returnFonts = [];
        foreach ($fonts as $key => $font) {
            //only font name not extension
            $fontName = pathinfo($font, PATHINFO_FILENAME);
            $returnFonts[] = [
                'id' => $key,
                'name' => $fontName,
                'url' => $this->targetDir . $font
            ];
        }
        return json_encode($returnFonts);
    }
    public function upload($file) {
        $fileName = basename($file["name"]);
        $targetFilePath = $this->targetDir . $fileName;

        // Check if the file is a TTF file
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (strtolower($fileType) !== 'ttf') {
            return new Response(false, "Only TTF files are allowed.");
        }

        // Upload file
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return new Response(true, "File uploaded successfully.", $fileName);
        } else {
            return new Response(false, "File upload failed.");
        }
    }
    public function delete($font) {
        $fontPath = $font;
        if (file_exists($fontPath)) {
            unlink($fontPath);
            return new Response(true, "Font deleted successfully.");
        } else {
            return new Response(false, "Font not found.");
        }
    }
}