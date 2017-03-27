<?php

class AjaxController extends Controller
{
    /**
     * Toggle status of item in items table ( finished/pending)
     * @param int $id
     */
    public function toggleStatus($id)
    {
        if($id)
        {
            $item = $this->model('Item');
            $rez = $item->db->updateRow('update items set status=if(status = "pending", "finished", "pending") where id = ?', [$id]);
            die(json_encode(['success' => 'saved', 'status' => 200]));
        }
    }
}