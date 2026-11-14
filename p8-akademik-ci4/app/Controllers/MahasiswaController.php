<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    private function validationRules()
    {
        return [
            'nim' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'NIM wajib diisi.',
                    'min_length' => 'NIM minimal harus 5 karakter.',
                    'max_length' => 'NIM maksimal 20 karakter.',
                ],
            ],
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama wajib diisi.',
                    'min_length' => 'Nama minimal harus 3 karakter.',
                    'max_length' => 'Nama maksimal 100 karakter.',
                ],
            ],
            'prodi' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Program studi wajib diisi.',
                    'max_length' => 'Program studi maksimal 100 karakter.',
                ],
            ],
            'ipk' => [
                'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[4]',
                'errors' => [
                    'required' => 'IPK wajib diisi.',
                    'numeric' => 'IPK harus berupa angka.',
                    'greater_than_equal_to' => 'IPK minimal 0.',
                    'less_than_equal_to' => 'IPK maksimal 4.',
                ],
            ],
        ];
    }

    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();

        return view('mahasiswa/index', $data);
    }

    public function create()
    {
        return view('mahasiswa/create', ['input' => []]);
    }

    public function store()
    {
        $data = [
            'nim'   => $this->request->getPost('nim'),
            'nama'  => $this->request->getPost('nama'),
            'prodi' => $this->request->getPost('prodi'),
            'ipk'   => $this->request->getPost('ipk'),
        ];

        if (!$this->validate($this->validationRules())) {
            return view('mahasiswa/create', [
                'validation' => $this->validator,
                'input' => $data,
            ]);
        }

        $model = new MahasiswaModel();
        $model->insert($data);

        return redirect()->to('/mahasiswa');
    }

    public function edit($id)
    {
        $model = new MahasiswaModel();
        $mahasiswa = $model->find($id);

        if (!$mahasiswa) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('mahasiswa/edit', [
            'mahasiswa' => $mahasiswa,
            'input' => $mahasiswa,
        ]);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();
        $mahasiswa = $model->find($id);

        if (!$mahasiswa) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'nim'   => $this->request->getPost('nim'),
            'nama'  => $this->request->getPost('nama'),
            'prodi' => $this->request->getPost('prodi'),
            'ipk'   => $this->request->getPost('ipk'),
        ];

        if (!$this->validate($this->validationRules())) {
            return view('mahasiswa/edit', [
                'mahasiswa' => $mahasiswa,
                'validation' => $this->validator,
                'input' => $data,
            ]);
        }

        $model->update($id, $data);

        return redirect()->to('/mahasiswa');
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);

        return redirect()->to('/mahasiswa');
    }
}
