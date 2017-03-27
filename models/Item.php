<?php

class Item extends Model
{
    /**
     * Return all items from items table except deleted
     * @return array
     */
    public function all()
    {
        return $this->db->selectRows('select * from items where deleted = 0');
    }
}