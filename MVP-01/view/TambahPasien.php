<?php


include_once("kontrak/KontrakPasien.php");
include_once("presenter/ProsesPasien.php");

class FormPasien implements KontrakPasienView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$data = null;
		$data .= '<form method="post" action="tambah.php">
		<div class="container mt-5">
		  <div>
			<div class="card-header">
      <h1 class="text-black text-center">Tambah Pasien</h1>
    </div>
			<div >
			  <div class="form-group">
				<label for="nik">NIK:</label>
				<input type="text" name="nik" class="form-control" required>
			  </div>
			  <div class="form-group">
				<label for="nama">Nama:</label>
				<input type="text" name="nama" class="form-control" required>
			  </div>
			  <div class="form-group">
				<label for="tempat">Tempat:</label>
				<input type="text" name="tempat" class="form-control" required>
			  </div>
			  <div class="form-group">
				<label for="lahir">Tanggal Lahir:</label>
				<input type="date" name="lahir" class="form-control" required>
			  </div>
			  <div class="form-group">
				<label for="gender">Gender:</label>
				<input type = "text" name="gender" class="form-control" required>
			</div>
			  <div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="email" class="form-control" required>
			  </div>
			  <div class="form-group">
				<label for="telp">Telepon:</label>
				<input type="tel" name="telp" class="form-control" required>
			  </div>
			</div>
			<div class="card-footer">
			  <button class="btn btn-success" type="submit" name="add">Submit</button>
			  <button class="btn btn-danger" type="reset">Cancel</button>
			</div>
		  </div>
		</div>
	  </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("DATA_TITLE", "Tambah");


		// Menampilkan ke layar
		$this->tpl->write();
	}

	function tampilUpdate($id)
	{
		$this->prosespasien->prosesDataPasien();

		$data = null;
		$data .= '<form method="post" action="tambah.php">
		<div class="container mt-5">
		  <div>
			<div class="card-header">
      <h1 class="text-black text-center">Update Pasien</h1>
    </div>
			<div >
			  <div class="form-group">
        <input type="hidden" name="id" value="' . $this->prosespasien->getId($id) . '" >
				<label for="nik">NIK:</label>
				<input type="text" name="nik" class="form-control" value="' . $this->prosespasien->getNik($id) . '" required>
			  </div>
			  <div class="form-group">
				<label for="nama">Nama:</label>
				<input type="text" name="nama" class="form-control" value="' . $this->prosespasien->getNama($id) . '" required>
			  </div>
			  <div class="form-group">
				<label for="tempat">Tempat:</label>
				<input type="text" name="tempat" class="form-control" value="' . $this->prosespasien->getTempat($id) . '" required>
			  </div>
			  <div class="form-group">
				<label for="lahir">Tanggal Lahir:</label>
				<input type="date" name="lahir" class="form-control" value="' . $this->prosespasien->getTl($id) . '" required>
			  </div>
			  <div class="form-group">
				<label for="gender">Gender:</label>
				<input type = "text" name="gender" class="form-control" value="' . $this->prosespasien->getGender($id) . '" required>
			</div>
			  <div class="form-group">
				<label for="email">Email:</label>
				<input type="email" name="email" class="form-control" value="' . $this->prosespasien->getEmail($id) . '" required>
			  </div>
			  <div class="form-group">
				<label for="telp">Telepon:</label>
				<input type="tel" name="telp" class="form-control" value="' . $this->prosespasien->getTelp($id) . '" required>
			  </div>
			</div>
			<div class="card-footer">
			  <button class="btn btn-success" type="submit" name="update">Perbarui</button>
			  <button class="btn btn-danger" type="reset">Batalkan</button>
			</div>
		  </div>
		</div>
	  </form>';

		// Membaca template skin.html
		$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("DATA_TITLE", "Update");

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function add($data)
	{
		$this->prosespasien->add($data);
	}

	function update($data)
	{
		$this->prosespasien->update($data);
	}
}
