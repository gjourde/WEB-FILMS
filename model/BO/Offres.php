<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offres
 *
 * @author Vince
 */
class Offres
{

    private $_id;
    private $_title;
    private $_description;

    public function __construct($id = null, $title = null, $description = null)
    {
        if (!is_null($id)) {
            $this->set_id($id);
        }
        $this->set_title($title);
        $this->set_description($description);
    }

    public function get_title()
    {
        return $this->_title;
    }

    public function get_description()
    {
        return $this->_description;
    }

    public function set_title($_title)
    {
        $this->_title = $_title;
    }

    public function set_description($_description)
    {
        $this->_description = $_description;
    }

    /**
     * Get the value of _id
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     */
    public function set_id($_id)
    {
        $this->_id = $_id;

    }
}
