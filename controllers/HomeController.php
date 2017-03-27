<?php

class HomeController extends Controller
{
    /**
     * Display home page with data
     */
    public function index()
    {
        $this->setJS('home');
        $this->view->js = $this->getJS();
        $model = $this->model('Item');
        $list = $model->all();
        $this->view->render('home', ['list' => $list]);
    }

    /**
     * Save new item into DB
     */
    public function save()
    {
        if(!$_POST['content'])
        {
            Session::set('error', 'Content not provided, please insert new task!!!');
            header('location: '. URL .'home');
        }
        $content = htmlspecialchars($_POST['content']);
        $item = $this->model('Item');
        $rez = $item->db->insertRow("insert into items(content) values (?)", [$content], true);
        Session::set('success', 'Data saved!');
        header('location: '. URL .'home');
    }

    /**
     * Soft delete record from DB
     * @param int $id - id of record to be deleted
     */
    public function delete($id)
    {
       if($id)
       {
          $item = $this->model('Item');
          $rez = $item->db->deleteRow("update items set deleted = 1 where id = (?)", [$id]);
       }
       header('location: '. URL .'home');
    }

    /**
     * Update record from Db
     * @param int $id - id of record to be updated
     */
    public function update($id)
    {
        if($id)
        {
            $content = $_POST['editItem'] ?? null;
            $item = $this->model('Item');
            $rez = $item->db->updateRow("update items set content = ? where id = (?)", [$content, $id]);
        }
        header('location: '. URL .'home');
    }
}