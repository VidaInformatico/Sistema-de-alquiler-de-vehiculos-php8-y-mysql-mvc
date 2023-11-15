<?php
class Views{

    public function getView($vista, $data="")
    {
        require "Views/" . $vista . ".php";
    }
}
?>