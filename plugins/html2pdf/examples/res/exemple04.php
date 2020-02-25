<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <table style='width:800px;margin:auto;'>
			<tr>
				<td>
					<table>
						<tr valign='top'>
							<td style='width:100px'>
								<span style='font-weight:bold;font-size:20px'>BORANG</span><br />
								<span style='font-weight:bold;font-size:40px'>8A</span><br />
								<img src='images/perkeso_logo.png' style='width:100px'/><br /><br />
								<span style='font-weight:bold;font-size:12px'>No. Kod Majikan</span><br /><br />
								<span style='font-weight:bold;font-size:12px'>Nama dan Alamat Majikan</span><br />
							</td>
							<td style='width:700px'>
								<table style='width:100%'>
									<tr>
										<td>
											<span style='font-size:25px'>PERTUBUHAN KESELAMATAN SOSIAL</span>
											<div style='font-size:13px;width:300px;margin:auto;'>JADUAL CARUMAN BULANAN</div>
											<div style='font-size:13px;width:350px;margin:auto;'>UNTUK CARUMAN BULAN <input type='text' style='width:40px' /> 201<input type='text' style='width:20px' /></div>
											<span style='font-size:10px'>Jumlah caruman untuk bulan d atas hendaklah dibayar tidak lewat daripada <input type='text' style='width:60px' /></span>
										</td>
									</tr>
									<tr>
										<td>
											<table style='border:1px solid #000000;border-collapse:collapse;width:100%;font-size:10px'>
												<tr>
													<td style='width:400px' colspan='2'>
														<table>
															<tr>
																<td><input type='checkbox' /></td>
																<td>Bayaran Tunai.</td>
															</tr>
															<tr>
																<td><input type='checkbox' /></td>
																<td> Bayaran cek. No. cek</td>
															</tr>
														</table>
													</td>
													<td>
														Amaun<br />
														RM <input type='text' style='width:40px' />
													</td>
													<td>
														Bilangan Pekerja
													</td>
													<td>
														Lembaran
													</td>
												</tr>
												<tr valign='top'>
													<td colspan='2' style='width:400px' >
														<br />
														<input type='text' />
													</td>
													<td colspan='3'>
														<ol>
															<li>NO. PENDAFTARAN KESELAMATAN SOSIAL ADALAH NOMBOR KAD PENGENALAN PENDAFTARAN NEGARA.</li>
															<li>Tandakan Tandakan XX di di ruangan ruangan (2) jika jika pekerja pekerja telah telah berhenti berhentikerja dan masukkan tarikh berhenti kerja di ruangan (3).</li>
															<li>Isikan tarikh mula kerja untuk pekerja yang tidak tersenarai sahaja di ruangan (3). Pendaftaran pekerja sedemikian hendaklah juga dibuat dalam borang 2.</li>
															<li>Jika tiada caruman sebab cuti tanpa gaji masukkan angka 00.00 di ruangan (6).</li>
															<li>Jika ada butir-butir yang didapati tidak betul, jangan buat pindaan di borang ini, sila beritahu PERKESO secara bertulis.</li>
															<li>Sila pastikan tulisan/angka/cap tidak menyentuh mana-mana garisan/kotak/barcode yang disediakan</li>
															<li>Format untuk tkh. mula/tkh. berhenti kerja adalah hhbbtttt contoh 01072000.</li>
														</ol>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table border style='border-collapse:collapse;font-size:12px'>
						<tr>
							<td style='width:150px'>
								NO. KAD PENGENALAN
								PENDAFTARAN NEGARA
								Lihat Catatan (1)
							</td>
							<td>(2)</td>
							<td style='width:100px'>
								TKH. MULA/TKH.
								BERHENTI KERJA
								hhbbtttt   (3)
							</td>
							<td style='width:100px'>
								KEGUNAAN PERKESO (4)
							</td>
							<td style='width:300px'>
								NAMA PEKERJA (MENGIKUT KAD PENGENALAN) (5)
							</td>
							<td style='width:105px'>
								CARUMAN (6)
								<div style='clear:both'></div>
								<div style='float:left;width:20px;height:20px;'>RM</div>
								<div style='float:left;width:20px;height:20px;'></div>
								<div style='float:left;width:20px;height:20px;'>SEN</div>
								<div style='clear:both'></div>
							</td>
						</tr>
						<?php
							for($i=0;$i<20;$i++){
						?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<?php
							}
						?>
						<tr>
							<td colspan='6'>&nbsp;
								<div style='float:right;width:220px;height:25px'>Jumlah muka surat ini <input type='text' style='width:100px' /></div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div style='float:right;width:250px;height:25px'>Jumlah Besar <input type='text' style='width:150px' /></div>
				</td>
			</tr>
			<tr>
				<td>
					<div style='font-size:12px'>
						PERHATIAN: <br />
						1.  Sila fotostat Borang 8A untuk rekod tuan.<br />
						2.  Untuk mendapatkan khidmat penceramah PERKESO, sila mohon di alamat e-mel berikut :- perkeso@perkeso.gov.my.
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<table style='font-size:12px;width:100%'>
						<tr>
							<td>Tandatangan</td>
							<td>:</td>
							<td><input type='text' /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Nama Penuh</td>
							<td>:</td>
							<td><input type='text' /></td>
							<td>No. Tel & Cap Majikan</td>
							<td>:</td>
							<td><input type='text' /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    </body>
</html>
