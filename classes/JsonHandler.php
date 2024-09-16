<?php

namespace App;

class JsonHandler
{
    protected $jsonFilePath;
    public function __construct()
    {
        $this->jsonFilePath = 'assets/font_groups.json';
        if (!file_exists($this->jsonFilePath)) {
            file_put_contents($this->jsonFilePath, json_encode([]));
        }
    }
    // Get all font groups
    public function getAll()
    {
        $json = file_get_contents($this->jsonFilePath);
        return json_decode($json, true);
    }
    // Create a new font group
    public function create($name, $fonts = [], $fontsName = [])
    {
        $fontGroups = $this->getAll();
        $id = uniqid('', true);

        $fontGroup = [
            'id'    => $id,
            'name'  => $name,
            'fonts' => $fonts,
            'fontsName' => $fontsName
        ];

        $fontGroups[] = $fontGroup;
        $this->saveAll($fontGroups);
        return $fontGroup;
    }
    // Get a font group by ID
    public function get($id)
    {
        $fontGroups = $this->getAll();
        foreach ($fontGroups as $fontGroup) {
            if ($fontGroup['id'] === $id) {
                return $fontGroup;
            }
        }
        return null;
    }

    // Update a font group by ID
    public function update($id, $name, $fonts = [], $fontsName = [])
    {
        $fontGroups = $this->getAll();
        $updateFrontGroup = [];
        foreach ($fontGroups as $fontGroup) {
            if ($fontGroup['id'] === $id) {
                $fontGroup['name'] = $name;
                $fontGroup['fonts'] = $fonts;
                $fontGroup['fontsName'] = $fontsName;
            }
            $updateFrontGroup[] = $fontGroup;
        }
        $this->saveAll($updateFrontGroup);
        return $this->get($id);
    }

    // Delete a font group by ID
    public function delete($id)
    {
        $fontGroups = $this->getAll();
        $newFontGroups = [];
        $deleted = false;

        foreach ($fontGroups as $fontGroup) {
            if ($fontGroup['id'] !== $id) {
                $newFontGroups[] = $fontGroup;
            } else {
                $deleted = true;
            }
        }

        if ($deleted) {
            $this->saveAll($newFontGroups);
            return true;
        }
        return false;
    }

    // Save all font groups to the JSON file
    private function saveAll($fontGroups)
    {
        $json = json_encode($fontGroups, JSON_PRETTY_PRINT);
        file_put_contents($this->jsonFilePath, $json);
    }
}