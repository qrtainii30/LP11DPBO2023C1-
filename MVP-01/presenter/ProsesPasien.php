<?php

include_once("kontrak/KontrakPasien.php");

class ProsesPasien implements KontrakPasienPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		// konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "db_mvp"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); // instansi TabelPasien
			$this->data = array(); // instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "Terjadi error: " . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			// mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				// ambil hasil query
				$pasien = new Pasien(); // instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); // mengisi id
				$pasien->setNik($row['nik']); // mengisi nik
				$pasien->setNama($row['nama']); // mengisi nama
				$pasien->setTempat($row['tempat']); // mengisi tempat
				$pasien->setTl($row['tl']); // mengisi tl
				$pasien->setGender($row['gender']); // mengisi gender
				$pasien->setEmail($row['email']); 
				$pasien->setTelp($row['telp']);

				$this->data[] = $pasien; // tambahkan objek pasien ke dalam list
			}
			// tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// memproses error
			echo "Terjadi error: " . $e->getMessage();
		}
	}

	function add($data)
	{
		$this->tabelpasien->open();
		$this->tabelpasien->addPasien($data);
		$this->tabelpasien->close();
		header("location:index.php");
	}

	function update($data)
	{
		$this->tabelpasien->open();
		$this->tabelpasien->updatePasien($data);
		$this->tabelpasien->close();
		header("location:index.php");
	}

	function deleteData($id)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->deletePasien($id);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			echo "Terjadi error: " . $e->getMessage();
		}
	}

	function getId($i)
	{
		// mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]->getId();
	}

	function getNik($i)
	{
		// mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]->getNik();
	}

	function getNama($i)
	{
		// mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]->getNama();
	}

	function getTempat($i)
	{
		// mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]->getTempat();
	}

	function getTl($i)
	{
		// mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]->getTl();
	}

	function getGender($i)
	{
		// mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]->getGender();
	}

	function getEmail($i)
	{
		// mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]->getEmail();
	}

	function getTelp($i)
	{
		// mengembalikan telp Pasien dengan indeks ke i
		return $this->data[$i]->getTelp();
	}

	function getSize()
	{
		return sizeof($this->data);
	}
}
