<?php
include_once 'Models/EditorModel.php';
class Editor{
    var $em;
    function __construct()
    {
        $this->em = new EditorModel();
    }

    function getAllEditor()
    {
        $data = $this->em->getAllEditor();
        return $data;
    }

    function getAllEditorByStatus($status)
    {
        $data = $this->em->getAllEditorByStatus($status);
        return $data;
    }
}
?>