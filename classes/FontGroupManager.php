<?php

namespace App;

class FontGroupManager
{
    protected $jsonHandler;

    public function __construct()
    {
        $this->jsonHandler = new JsonHandler();
    }
    public function getGroups() {
        return $this->jsonHandler->getAll();
    }
    public function createGroup($groupName, $fonts, $name) {
        if (count($fonts) < 2) {
            return new Response(false, "At least two fonts are required.");
        }
        $fontGroups = $this->jsonHandler->create($groupName, $fonts, $name);
        return new Response(true, "Font group created successfully.", $fontGroups);
    }

    public function editGroup($groupId) {
        $fontGroup = $this->jsonHandler->get($groupId);
        if($fontGroup) {
            return $fontGroup;
        }
        return new Response(false, "Font group not found.");
    }

    public function updateGroup($groupId, $groupName, $fonts, $name) {
        $fontGroup = $this->jsonHandler->update($groupId, $groupName, $fonts, $name);
        return new Response(true, "Font group updated successfully.", $fontGroup);
    }

    public function deleteGroup($groupId) {
        $fontGroup = $this->jsonHandler->delete($groupId);
        if($fontGroup) {
            return new Response(true, "Font group deleted successfully.");
        }
        return new Response(false, "Font group not found.");
    }
}