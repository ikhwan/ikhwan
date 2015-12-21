<?php 

/**
 * method to insert of other table (table B = exampel => jadwal_petugas_datetime ), with field name startDate_endDate 
 * This is model from table B and table B 
 * create method to looping data from startDate and endDate
 */

class jadwal_petugas_datetime extends BaseModel {
	
	use Carbon\Carbon; //used to format datetime

	public function getDate() {

		containet()->instance('JadwalPetugas', $JadwalPetugas); //inject model JadwalPetugas
		$startDate = Carbon::createFromFormat('Y-m-d', $JadwalPetugas->start_date);
		$endDate = Carbon::createFromFormat('Y-m-d', $JadwalPetugas->endDate);

		while ($startDate <= $endDate) {
			
			$model = new static; //buat modelnya sendiri

			$model->attributes = [ //set attributs
				'id_jadwal_petugas' => (int) $JadwalPetugas->id,
				'startDate_endDate' => $startDate->format('Y-m-d'),
			];

			if ($model->validate()) { 
				$model->save(); //save 
				$startDate->addDay(); //addDay dari method Carbon
			} else {
				throw new Exception('Tidak Bisa Menyimpan Data Tanggal', 1);
			}
		}

	}

}