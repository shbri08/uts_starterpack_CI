<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoryModel;

class Categories extends Controller
{
    private $link = 'categories';
    private $view = 'categories';
    private $title = 'categories';
    private $model;
    private $dir = 'public/assets/uploads/categories';
    public function __construct()
    {
        $this->model = new \App\Models\CategoryModel();
    }

    public function index()
    {
        $model = new CategoryModel();
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'categories' => $model->findAll() // Mengambil semua kategori dari model
            
        ];

        return view('categories/index', $data);
    }
    public function show($id_categories = null)
    {
        return redirect()->to($this->link);
    }
    public function view($id)
    {
        $model = new CategoryModel();
        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'category' => $model->find($id) // Mengambil kategori berdasarkan ID
        ];

        return view('categories/view', $data);
    }

    public function new()
    {
        $data = [
            'title' => $this->title,
            'link' => $this->link
        ];

        return view($this->view . '/new', $data);
    }

    public function create()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => htmlspecialchars($this->request->getVar('name')),
            'description' => htmlspecialchars($this->request->getVar('description')),
        ];

        $res = $this->model->save($data);
        if ($res) {
            setAlert('success', 'Success', 'Add Success');
        } else {
            setAlert('warning', 'Warning', 'Add Failed');
        }

        return redirect()->to($this->link);
    }

    public function edit($id = null)
    {
        $result = $this->model->find($id);
        if (!$result) {
            setAlert('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'data' => $result,
        ];

        return view($this->view . '/edit', $data);
    }

    public function update($id = null)
    {
        $result = $this->model->find($id);
        if (!$result) {
            setAlert('warning', 'Warning', 'NOT VALID');
            return redirect()->to($this->link);
        }

        $rules = [
            'name' => 'required',
        ];

        $input = $this->request->getVar();

        
        if ($input['name'] != $result['name']) {
            $rules['name'] = 'required|is_unique[categories.name]';
        }
        if ($input['description'] != $result['description']) {
            $rules['description'] = 'required|is_unique[categories.description]';
        }

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => htmlspecialchars($this->request->getVar('name')),
            'description' => htmlspecialchars($this->request->getVar('description')),
            
        ];

       
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