<?php

namespace App\Controllers;

use App\Models\BookModel;

class BookController extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $keyword = $this->request->getVar('search');
        
        if ($keyword) {
            $books = $bookModel->search($keyword);
        } else {
            $books = $bookModel;
        }

        $perPage = 5;
        $data = [
            'books'     => $books->paginate($perPage, 'default'),
            'pager'     => $bookModel->pager,
            'search'    => $keyword,
            'title'     => 'Katalog Buku Digital'
        ];

        return view('books/index', $data);
    }

    public function view($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Buku tidak ditemukan.');
        }

        $data = [
            'book'  => $book,
            'title' => 'Detail Buku - ' . $book['title']
        ];

        return view('books/view', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Buku Baru'
        ];
        return view('books/create', $data);
    }

    public function store()
    {
        $bookModel = new BookModel();
        
        $rules = [
            'title'          => 'required|min_length[3]|max_length[255]',
            'author'         => 'required|min_length[3]|max_length[100]',
            'publisher'      => 'required',
            'year_published' => 'required|numeric|exact_length[4]',
            'isbn'           => 'required',
            'category'       => 'required',
            'quantity'       => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $cover = $this->request->getFile('cover_image');
        $coverName = null;

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $coverName = $cover->getRandomName();
            $cover->move(ROOTPATH . 'public/uploads', $coverName);
        }

        $bookModel->save([
            'title'          => $this->request->getPost('title'),
            'author'         => $this->request->getPost('author'),
            'publisher'      => $this->request->getPost('publisher'),
            'year_published' => $this->request->getPost('year_published'),
            'isbn'           => $this->request->getPost('isbn'),
            'category'       => $this->request->getPost('category'),
            'synopsis'       => $this->request->getPost('synopsis'),
            'cover_image'    => $coverName,
            'quantity'       => $this->request->getPost('quantity'),
        ]);

        return redirect()->to(base_url('books'))->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Buku tidak ditemukan.');
        }

        $data = [
            'book'  => $book,
            'title' => 'Edit Buku - ' . $book['title']
        ];

        return view('books/edit', $data);
    }

    public function update($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Buku tidak ditemukan.');
        }

        $rules = [
            'title'          => 'required|min_length[3]|max_length[255]',
            'author'         => 'required|min_length[3]|max_length[100]',
            'publisher'      => 'required',
            'year_published' => 'required|numeric|exact_length[4]',
            'isbn'           => 'required',
            'category'       => 'required',
            'quantity'       => 'required|numeric|greater_than_equal_to[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $cover = $this->request->getFile('cover_image');
        $coverName = $book['cover_image'];

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            if ($coverName && file_exists(ROOTPATH . 'public/uploads/' . $coverName)) {
                unlink(ROOTPATH . 'public/uploads/' . $coverName);
            }
            $coverName = $cover->getRandomName();
            $cover->move(ROOTPATH . 'public/uploads', $coverName);
        }

        $bookModel->update($id, [
            'title'          => $this->request->getPost('title'),
            'author'         => $this->request->getPost('author'),
            'publisher'      => $this->request->getPost('publisher'),
            'year_published' => $this->request->getPost('year_published'),
            'isbn'           => $this->request->getPost('isbn'),
            'category'       => $this->request->getPost('category'),
            'synopsis'       => $this->request->getPost('synopsis'),
            'cover_image'    => $coverName,
            'quantity'       => $this->request->getPost('quantity'),
        ]);

        return redirect()->to(base_url('books'))->with('success', 'Buku berhasil diperbarui.');
    }

    public function delete($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (!$book) {
            return redirect()->to(base_url('books'))->with('error', 'Buku tidak ditemukan.');
        }

        if ($book['cover_image'] && file_exists(ROOTPATH . 'public/uploads/' . $book['cover_image'])) {
            unlink(ROOTPATH . 'public/uploads/' . $book['cover_image']);
        }

        $bookModel->delete($id);

        return redirect()->to(base_url('books'))->with('success', 'Buku berhasil dihapus.');
    }
}
