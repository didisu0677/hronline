<div class="mt-lg-4 pt-2 pb-2 mt-0">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card mb-3">
				<div class="card-header">Data Lowongan</div>
				<div class="card-body table-responsoive">
					<table class="table table-bordered table-detail mb-0">
						<tr>
							<th width="200">Deskripsi</th>
							<td><?php echo $deskripsi; ?></td>
						</tr>
						<tr>
							<th>Lokasi</th>
							<td><?php echo $nama_lokasi; ?></td>
						</tr>
						<tr>
							<th>Tanggal di buka</th>
							<td><?php echo date_indo($tanggal_berlaku); ?></td>
						</tr>
						<tr>
							<th>Tanggal di tutup</th>
							<td><?php echo date_indo($tanggal_berakhir); ?></td>
						</tr>

					</table>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header">Jadwal Pengadaan</div>
				<div class="card-body">
					<div class="alert alert-info">Silakan kirimkan lamaran anda dengan mengklik tautan berikut  
						<a href="javascript:;" class="btn-daftar">Kirim Aplikasi</a>
						</div>
				</div>
			</div>
			<div class="text-center">
				<a href="javascript:;" onclick="history.back()" class="btn btn-secondary"><i class="fa-chevron-left"></i> &nbsp; Kembali</a>
			</div>
		</div>
	</div>
</div>