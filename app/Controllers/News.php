<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NewsModel;
use App\Models\CategoryModel;

class News extends Controller
{
    private $link = 'news';
    private $view = 'news';
    private $title = 'news';
    private $dir = 'public/assets/uploads/news';

    private $model;
    public function __construct()
    {
        $this->model = new \App\Models\NewsModel();
    }

    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
    
        $newsModel = new NewsModel();
        $news = $newsModel->getNewsWithCategories();

        $model = new NewsModel();
        $data = [
            'tittle' => $this->title,
            'link' => $this->link,
            'news' => $model->findAll(),
            'categories' => $categories
        ];

        return view('news/index', $data);
    }

    public function view($id)
    {
        $model = new NewsModel();
        $data = [
            'tittle' => $this->title,
            'link' => $this->link,
            'news' => $model->find($id)
        ];

        return view('news/view', $data);
    }

    public function new()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $data = [
        'title' => $this->title,
        'categories' => $categories, 
        'link' => $this->link,
    ];

    return view('news/new', $data);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();

        $rules = [
            'tittle' => 'required',
            'description' => 'required',
            'id_categories' => 'required',
            'date' =>'required|valid_date'
        ];        
        
        $dataBerkas = $this->request->getFile('image');
        
        if ($dataBerkas && $dataBerkas->getError() !== null && $dataBerkas->getError() != 4) {
            $rules['image'] = 'uploaded[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg]|ext_in[image,png,jpg,gif]|is_image[image]';
        }
        
        $input = $this->request->getVar();
        
        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'tittle' => htmlspecialchars($this->request->getVar('tittle')),
            'description' => htmlspecialchars($this->request->getVar('description')),
            'id_categories' => htmlspecialchars($this->request->getVar('id_categories')),
            'date' => htmlspecialchars($this->request->getVar('date'))
        ];

        if ($dataBerkas && $dataBerkas->getError() !== null && $dataBerkas->getError() != 4) {

            $fileName = $dataBerkas->getName();

            $dataBerkas->move($this->dir, $fileName);

            $data['image'] = $fileName;
        }

        $res = $this->model->save($data);
        if ($res) {
            setAlert('success', 'Success', 'Add Success');
        } else {
            setAlert('warning', 'Warning', 'Add Failed');
        }

        return redirect()->to($this->link);
    }

    public function edit($id= null)
    {
        
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        

        $rules = [
            'tittle' => 'required',
            'description' => 'required',
            'id_categories' => 'required',
            'date' =>'required|valid_date'
        ]; 

        $result = $this->model->find($id);
        if (!$result) {
            setAlert('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'tittle' => $this->title,
            'link' => $this->link,
            'data' => $result,
            'categories' => $categories,
           
        ];

        return view($this->view . '/edit', $data);
    }

    public function update($id = null)
{
    $categoryModel = new CategoryModel();
    $categories = $categoryModel->findAll();

    $result = $this->model->find($id);
    if (!$result) {
        setAlert('warning', 'Warning', 'NOT VALID');
        return redirect()->to($this->link);
    }

    $rules = [
        'tittle' => 'required',
        'description' => 'required',
        'id_categories' => 'required',
        'date' =>'required|valid_date'
    ]; 
    $input = $this->request->getVar();

    // Pastikan $result tidak null
    if ($result && array_key_exists('tittle', $result) && array_key_exists('description', $result) &&
        array_key_exists('category_name', $result) && array_key_exists('date', $result)) {

        // Pastikan data yang diterima sesuai dengan yang diharapkan
        if ($input['tittle'] != $result['tittle']) {
            $rules['tittle'] = 'required|is_unique[news.tittle]';
        }
        if ($input['description'] != $result['description']) {
            $rules['description'] = 'required|is_unique[news.description]';
        }
        if ($input['category_name'] != $result['category_name']) {
            $rules['category_name'] = 'required|is_unique[news.category_name]';
        }
        if ($input['date'] != $result['date']) {
            $rules['date'] = 'required|is_unique[news.date]';
        }
    } else {
        // Jika data tidak lengkap, tampilkan pesan error atau lakukan tindakan lain sesuai kebutuhan
        // Contoh:
        setAlert('warning', 'Warning', 'Data is incomplete');
        return redirect()->to($this->link);
    }

    $dataBerkas = $this->request->getFile('image');

    if ($dataBerkas->getError() != 4) {
        $rules['image'] = 'uploaded[image]|max_size[image,2048]|mime_in[image,image/png,image/jpeg]|ext_in[image,png,jpg,gif]|is_image[image]';
    }

    if (!$this->validateData($input, $rules)) {
        return redirect()->back()->withInput();
    }

    $data = [
        'tittle' => htmlspecialchars($this->request->getVar('tittle')),
        'description' => htmlspecialchars($this->request->getVar('description')),
        'category_name' => htmlspecialchars($this->request->getVar('category_name')),
        'date' => htmlspecialchars($this->request->getVar('date')),
        
    ];

    if ($dataBerkas->getError() != 4) {

        $fileName = $dataBerkas->getName();

        $dataBerkas->move($this->dir, $fileName);

        $data['image'] = $fileName;

        if ($result['image'] != 'user.png') {
            @unlink($this->dir . '/' . $result['image']);
        }
    }
       
        $res = $this->model->update($id, $data);
        if ($res) {
            setAlert('success', 'Success', 'Edit Success');
        } else {
            setAlert('warning', 'Warning', 'Edit Failed');
        }

        return redirect()->to($this->link);
    }

    public function delete($id = null)
    {
        $result = $this->model->find($id);
        if (!$result) {
            setAlert('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $res = $this->model->delete($id);
        if ($res) {
            setAlert('success', 'Success', 'Delete Success');
        } else {
            setAlert('warning', 'Warning', 'Delete Failed');
        }

        return redirect()->to($this->link);
    }


}