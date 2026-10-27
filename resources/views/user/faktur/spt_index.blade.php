<form class="form-horizontal ng-pristine ng-scope ng-valid-date ng-valid ng-valid-required" name="formInduk" cg-busy="{promise:formIndukController.cgBusyPromise, message:'Loading...',backdrop:true}" novalidate="" style="position: relative;">
	<div id="accordion1" class="panel-group">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_1" aria-expanded="true"> I. PENYERAHAN BARANG DAN JASA </a>
	            </h4>
	        </div>
	        <div id="accordion1_1" class="panel-collapse collapse in" aria-expanded="true" style="">
	            <div class="panel-body"> 
	            	<table class="table table-hover">
	            		<tbody>
	            			<tr>
	            				<td colspan="2">A. Terutang PPN</td>
	            				<th class="text-center" width="15%">DPP</th>
	            				<th class="text-center" width="15%">PPN</th>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>1. Ekspor</td>
	            				<td class="text-center">0</td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>2. Penyerahan yang PPN-nya harus dipungut sendiri</td>
	            				<td class="text-center">0</td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>3. Penyerahan yang PPN-nya dipungut oleh Pemungut PPN</td>
	            				<td class="text-center">0</td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>4. Penyerahan yang PPN-nya tidak dipungut</td>
	            				<td class="text-center">0</td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>5. Penyerahan yang dibebaskan dari pengenaan PPN</td>
	            				<td class="text-center">0</td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td></td>
	            				<td>Jumlah (I.A.1 + I.A.2 + I.A.3 + I.A.4 + I.A.5 )</td>
	            				<td class="text-center">0</td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td td="" colspan="2">B. Tidak Terutang PPN</td>
	            				<td><input name="isian I.B" class="form-control fo-sm ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required" style="text-align: center" ng-model="formIndukController.sptInduk.attribute26" ng-blur="formIndukController.attribute26Changed()" type="text" ui-number-mask="0" ui-negative-number="" required=""></td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">C. Jumlah Seluruh Penyerahan ( I.A + I.B)</td>
	            				<td class="text-center">0</td>
	            				<td></td>
	            			</tr>
	            		</tbody>
	            	</table> 
	            </div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_2" aria-expanded="false"> II. PENGHITUNGAN PPN KURANG/LEBIH BAYAR</a>
	            </h4>
	        </div>
	        <div id="accordion1_2" class="panel-collapse collapse" aria-expanded="false">
	            <div class="panel-body"> 
					<table class="table table-hover">
	            		<tbody>
	            			<tr>
	            				<td>A. Pajak Keluaran yang harus dipungut sendiri</td>
	            				<td width="15%"></td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td>B. PPN disetor dimuka dalam Masa Pajak yang sama</td>
	            				<td>
	            					<div class="col-md-2">
								        	<span>
									            <a class="label label-sm label-success" ng-click="formIndukController.openUangMuka()"><i class="fa fa-search"></i></a>
									        </span>
										</div>
	            				</td>
	            				<!--   <td align="center"><input id="attribute29" name="isian II. B" class="form-control input-sm" style="text-align: center" ng-model="formIndukController.sptInduk.attribute29" type="text" ui-number-mask="0" ng-blur="formIndukController.attribute29Changed()" ng-min="0" required></td> -->
	            				<td align="center" width="15%"><div id="attribute29" name="isian II. B" class="ng-binding">0</div></td>
	            			</tr>
	            			<tr>
	            				<td>C. Pajak Masukan yang dapat diperhitungkan</td>
	            				<td></td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td>D. PPN kurang atau (lebih) bayar (II.A-II.B-II.C)</td>
	            				<td></td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td>E. PPN kurang atau (lebih) bayar pada SPT yang dibetulkan</td>
	            				<td></td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td>F. PPN kurang atau (lebih) bayar karena pembetulan (II.D-IIE)</td>
	            				<td></td>
	            				<td class="text-center"></td>
	            			</tr>
	            			<tr>
	            				<td>G. PPN Kurang bayar dilunasi tanggal <strong class="ng-binding"></strong>(dd-mm-yyyy) </td>
	            				<td colspan="2">
								    <div class="form-group">
								        <div class="col-md-10">
						        			NTPN : <strong class="ng-binding"></strong>
								        </div>
								        <div class="col-md-2">
								        	<span>
									            
									        </span>
										</div>
								    </div>
							    </td>
	            			</tr>
	            		</tbody>
	            	</table> 
	            	<table class="table table-hover">
	            		<tbody>
							<tr>
								<td colspan="4">H. PPN lebih bayar pada</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2">1.1 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute36" ng-disabled="!formIndukController.attribute36isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute36)" ng-change="formIndukController.attribute36Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Butir II.D (Bukan SPT Pembetulan) </td>
								<td>1.2 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute37" ng-disabled="!formIndukController.attribute37isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute37)" ng-change="formIndukController.attribute37Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Butir II. D atau   
									<input type="checkbox" ng-model="formIndukController.sptInduk.attribute38" ng-disabled="!formIndukController.attribute38isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute38)" ng-change="formIndukController.attribute38Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Butir II.F (SPT Pembetulan)</td>
							</tr>
							<tr>
								<td>oleh</td>
								<td colspan="2">2.1 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute39" ng-disabled="!formIndukController.attribute39isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute39)" ng-change="formIndukController.attribute39Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled">  PKP Pasal 9 ayat (4b) PPN</td>
								<td>2.2 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute40" ng-disabled="!formIndukController.attribute40isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute40)" ng-change="formIndukController.attribute40Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Selain PKP Pasal 9 ayat (4b) PPN</td>
							</tr>
							<tr>
								<td colspan="2">diminta untuk</td>
								<td>3.1 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute41" ng-disabled="!formIndukController.attribute41isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute41)" ng-change="formIndukController.attribute41Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Dikompensaikan ke Masa Pajak berikutnya,</td>
								<td><input type="checkbox" ng-model="formIndukController.sptInduk.attribute42" ng-disabled="!formIndukController.attribute42isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute42)" ng-change="formIndukController.attribute42Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Dikompensasikan ke Masa Pajak (mm-yyyy) <input type="text" size="2" ng-model="formIndukController.sptInduk.attribute43" ng-disabled="!formIndukController.attribute43isEnabled" limit-to="2" number-only="" format-masa="" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> - <input type="text" size="4" ng-model="formIndukController.sptInduk.attribute44" ng-disabled="!formIndukController.attribute44isEnabled" limit-to="4" number-only="" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>3.2 <input type="checkbox" ng-model="formIndukController.sptInduk.attribute45" ng-disabled="!formIndukController.attribute45isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute45)" ng-change="formIndukController.attribute45Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Dikembalikan (Restitusi)</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="4">Khusus Restitusi untuk PKP :</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute46" ng-disabled="!formIndukController.attribute46isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute46)" ng-change="formIndukController.attribute46Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Pasal 17C KUP, dilakukan dengan</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="checkbox" ng-model="formIndukController.sptInduk.attribute47" ng-disabled="!formIndukController.attribute47isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute47)" ng-change="formIndukController.attribute47Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Prosedur Biasa,</td>
								<td><input type="checkbox" ng-model="formIndukController.sptInduk.attribute48" ng-disabled="!formIndukController.attribute48isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute48)" ng-change="formIndukController.attribute48Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Pengembalian Pendahuluan</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute49" ng-disabled="!formIndukController.attribute49isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute49)" ng-change="formIndukController.attribute49Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Pasal 17D KUP, dilakukan dengan</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="checkbox" ng-model="formIndukController.sptInduk.attribute50" ng-disabled="!formIndukController.attribute50isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute50)" ng-change="formIndukController.attribute50Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled">  Prosedur Biasa, </td>
								<td><input type="checkbox" ng-model="formIndukController.sptInduk.attribute51" ng-disabled="!formIndukController.attribute51isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute51)" ng-change="formIndukController.attribute51Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> Pengembalian Pendahuluan</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute52" ng-disabled="!formIndukController.attribute52isEnabled" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute52)" ng-change="formIndukController.attribute52Changed()" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled">  Pasal 9 ayat (4c) PPN dilakukan dengan Pengembalian Pendahuluan</td>
							</tr>
						</tbody>
					</table>  
				</div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_3" aria-expanded="false"> III. PPN TERUTANG ATAS KEGIATAN MEMBANGUN SENDIRI </a>
	            </h4>
	        </div>
	        <div id="accordion1_3" class="panel-collapse collapse" aria-expanded="false">
	            <div class="panel-body"> 
	            	<table class="table table-hover">
	            		<tbody>
	            			<tr>
	            				<td width="30%">A. Jumlah Dasar Pengenaan Pajak</td>
	            				<td width="15%"><input class="form-control input-sm ng-pristine ng-untouched ng-valid ng-not-empty" style="text-align: center" ng-model="formIndukController.sptInduk.attribute53" ng-blur="formIndukController.attribute53Changed()" type="text" ui-number-mask="0"></td>
	            				<td width="30%"></td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td>B. PPN Terutang</td>
	            				<td><input class="form-control input-sm ng-pristine ng-untouched ng-valid ng-not-empty" style="text-align: center" ng-model="formIndukController.sptInduk.attribute54" ng-blur="formIndukController.attribute54Changed()" type="text" ui-number-mask="0"></td>
	            				<td></td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">C. Dilunasi Tanggal <strong class="ng-binding"></strong>(dd-mm-yyyy)</td>
	            				<td><div class="form-group">
								        <div class="form-group">
									        <div class="col-md-10">
							        			NTPN : <strong class="ng-binding"></strong>
									        </div>
									        <div class="col-md-2">
									        	<span>
										            <!-- ngIf: formIndukController.ssp1isEnabled -->
										        </span>
											</div>
									    </div>
								    </div>
								</td>
	            				<td></td>
	            			</tr>
	            		</tbody>
	            	</table> 
	            </div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_4" aria-expanded="false"> IV. PEMBAYARAN KEMBALI PAJAK MASUKAN BAGI PKP GAGAL BERPRODUKSI </a>
	            </h4>
	        </div>
	        <div id="accordion1_4" class="panel-collapse collapse" aria-expanded="false">
	            <div class="panel-body"> 
					<table class="table table-hover">
	            		<tbody>
	            			<tr>
	            				<td width="30%">A. PPN yang wajib dibayar kembali</td>
	            				<td width="15%"><input class="form-control input-sm ng-pristine ng-untouched ng-valid ng-not-empty" style="text-align: center" ng-model="formIndukController.sptInduk.attribute57" ng-blur="formIndukController.attribute57Changed()" type="text" ui-number-mask="0"></td>
	            				<td width="30%"></td>
	            				<td></td>
	            			</tr>
	            			<tr>
	            				<td colspan="2">B. Dilunasi Tanggal <strong class="ng-binding"></strong>(dd-mm-yyyy)</td>
	            				<td><div class="form-group">
								        <div class="form-group">
									        <div class="col-md-10">
							        			NTPN : <strong class="ng-binding"></strong>
									        </div>
									        <div class="col-md-2">
									        	<span>
										            <!-- ngIf: formIndukController.ssp2isEnabled -->
										        </span>
											</div>
									    </div>
								    </div>
								</td>
	            				<td></td>
	            			</tr>
	            		</tbody>
	            	</table> 
				</div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_5" aria-expanded="false"> V. PAJAK PENJUALAN ATAS BARANG MEWAH </a>
	            </h4>
	        </div>
	        <div id="accordion1_5" class="panel-collapse collapse" aria-expanded="false">
	            <div class="panel-body">
					<table class="table table-hover">
	            		<tbody>
	            			<tr>
	            				<td>A. PPnBM yang harus dipungut sendiri</td>
	            				<td width="15%"></td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td>B. PPnBM Disetor Dimuka Dalam Masa Pajak Yang Sama</td>
	            				<td></td>
	            				<td align="center"><input class="form-control input-sm ng-pristine ng-untouched ng-valid ng-not-empty" style="text-align: center" ng-model="formIndukController.sptInduk.attribute61" ng-blur="formIndukController.attribute61Changed()" type="text" ui-number-mask="0"></td>
	            			</tr>
	            			<tr>
	            				<td>C. PPnBM kurang atau (lebih) bayar (V.A-V.B)</td>
	            				<td></td>
	            				<td class="text-center">0</td>
	            			</tr>
	            			<tr>
	            				<td>D. PPnBM kurang atau (lebih) bayar pada SPT yang dibetulkan</td>
	            				<td></td>
	            				<td align="center"><!-- ngIf: formIndukController.sptInduk.attribute12 != 0 --></td>
	            			</tr>
	            			<tr>
	            				<td>E. PPnBM kurang atau (lebih) bayar karena pembetulan (V.C-V.D)</td>
	            				<td></td>
	            				<td class="text-center"></td>
	            			</tr>
	            			<tr>
	            				<td>F. PPnBM Kurang bayar dilunasi tanggal <strong class="ng-binding"></strong> (dd-mm-yyyy) 
								</td>
	            				<td colspan="2">
								    <div class="form-group">
								        <div class="col-md-10">
						        			NTPN : <strong class="ng-binding"></strong>
								        </div>
								        <div class="col-md-2">
								        	<span>
									            <!-- ngIf: formIndukController.ssp3isEnabled -->
									        </span>
										</div>
								    </div>
							    </td>
	            			</tr>
	            		</tbody>
	            	</table> 
				</div>
	        </div>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h4 class="panel-title">
	                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#" data-target="#accordion1_6" aria-expanded="false"> VI. KELENGKAPAN SPT </a>
	            </h4>
	        </div>
	        <div id="accordion1_6" class="panel-collapse collapse" aria-expanded="false">
	            <div class="panel-body"> 
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute67" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute67)" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked"> Formulir 1111 AB</div>
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute69" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute69)" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked"> Formulir 1111 A2</div>
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute71" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute71)" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked"> Formulir 1111 B2</div>
	            			<div class="col-md-2 ng-binding"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute73" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute73)" class="ng-pristine ng-untouched ng-valid ng-empty"> SSP PPN  lembar</div>
	            			<div class="col-md-4"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute77" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77)" class="ng-pristine ng-untouched ng-valid ng-empty"> Surat Kuasa Khusus</div>
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-12">
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute68" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77).CBool(formIndukController.sptInduk.attribute68)" class="ng-pristine ng-untouched ng-valid ng-not-empty"> Formulir 1111 A1</div>
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute70" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77).CBool(formIndukController.sptInduk.attribute70)" class="ng-pristine ng-untouched ng-valid ng-not-empty"> Formulir 1111 B1</div>
	            			<div class="col-md-2"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute72" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77).CBool(formIndukController.sptInduk.attribute72)" class="ng-pristine ng-untouched ng-valid ng-not-empty"> Formulir 1111 B3</div>
	            			<div class="col-md-2 ng-binding"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute75" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77).CBool(formIndukController.sptInduk.attribute75)" class="ng-pristine ng-untouched ng-valid ng-empty"> SSP PPnBM 0 lembar</div>
	            			<div class="col-md-4"><input type="checkbox" ng-model="formIndukController.sptInduk.attribute78" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute77).CBool(formIndukController.sptInduk.attribute78)" class="ng-pristine ng-untouched ng-valid ng-empty">  <input ng-model="formIndukController.sptInduk.attribute79" type="text" ng-disabled="formIndukController.sptInduk.attribute78 === 0" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> , <input ng-model="formIndukController.sptInduk.attribute80" size="3" type="text" ng-disabled="formIndukController.sptInduk.attribute78 === 0" class="ng-pristine ng-untouched ng-valid ng-empty" disabled="disabled"> lembar </div>
	            		</div>
	            	</div>
				</div>
	        </div>
	    </div>
	</div>
	<div class="row">
		<div class="col-md-5">
			<div class="note note-info">
     			<h4 class="block bold">PERNYATAAN</h4>
     			<div class="md-checkbox has-error">
                   <input type="checkbox" id="check_setuju" class="md-check ng-pristine ng-untouched ng-valid ng-empty" ng-model="formIndukController.setuju" ng-true-value="1" ng-false-value="0">
                   <label for="check_setuju">
                       <span></span>
                       <span class="check"></span>
                       <span class="box"></span> 
					DENGAN MENYADARI SEPENUHNYA AKAN SEGALA AKIBATNYA, SAYA MENYATAKAN BAHWA APA YANG TELAH SAYA BERITAHUKAN DIATAS BESERTA LAMPIRAN-LAMPIRANNYA ADALAH BENAR, LENGKAP, JELAS DAN TIDAK BERSYARAT 
				</label>
               </div>
	        </div>
        </div>
	    <div class="col-md-7">
		    <div class="form-group">
			    <div class="col-md-5">
			        <input id="attribute81" name="Tempat Penandatangan" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required" placeholder="Tempat Penandatangan" type="text" ng-model="formIndukController.sptInduk.attribute81" required="">
			    </div>
			    <div class="col-md-5">
			    	
			    	<div class="input-group">
                         <input type="text" id="attribute82" name="Tanggal SPT" ng-model="formIndukController.sptInduk.attribute82" ng-model-options="{ timezone: 'UTC' }" class="form-control ng-pristine ng-untouched ng-isolate-scope ng-valid-date ng-not-empty ng-valid ng-valid-required" uib-datepicker-popup="dd-MM-yyyy" is-open="popup.opened" close-text="Close" placeholder="Tanggal" datepicker-options="dateOptions" required=""><div uib-datepicker-popup-wrap="" ng-model="date" ng-change="dateSelection(date)" template-url="uib/template/datepickerPopup/popup.html" class="ng-pristine ng-untouched ng-valid ng-scope ng-not-empty"><!-- ngIf: isOpen --></div>

			              <span class="input-group-btn">
				                <button type="button" class="btn btn-default" ng-click="open()">
	                                <i class="glyphicon glyphicon-calendar"></i>
	                            </button>
			              </span>
                     </div>
			    </div>
			</div>
			<div class="mt-checkbox-inline">
			    <label class="mt-checkbox mt-checkbox-outline">
			        <input type="checkbox" ng-model="formIndukController.sptInduk.attribute83" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute83)" disabled="" class="ng-pristine ng-untouched ng-valid ng-not-empty" checked="checked"> PKP
			        <span></span>
			    </label>
			    <label class="mt-checkbox mt-checkbox-outline">
			        <input type="checkbox" ng-model="formIndukController.sptInduk.attribute84" ng-true-value="1" ng-false-value="0" ng-checked="formIndukController.CBool(formIndukController.sptInduk.attribute84)" disabled="" class="ng-pristine ng-untouched ng-valid ng-empty"> KUASA
			        <span></span>
			    </label>
			</div>
			<div class="form-group">
			    <label class="col-md-3 control-label">Nama Jelas</label>
			    <div class="col-md-6">
			        <input id="attribute86" name="Nama Penandatangan" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required" type="text" ng-model="formIndukController.sptInduk.attribute86" required="">
			    </div>
			</div>
			
			<div class="form-group">
			    <label class="col-md-3 control-label">Jabatan</label>
			    <div class="col-md-6">
			        <input id="attribute87" name="Jabatan Penandatangan" class="form-control ng-pristine ng-untouched ng-not-empty ng-valid ng-valid-required" type="text" ng-model="formIndukController.sptInduk.attribute87" required="">
			    </div>
			</div>
		</div> 
		
		<ul>
		  <!-- ngRepeat: (key, errors) in formInduk.$error track by $index -->
		</ul>      
	</div>
	<div class="form-actions">
	    <div class="row">
	        <div class="col-md-offset-4 col-md-8">
	            <button type="button" class="btn default">Cancel</button>
	            <button type="submit" class="btn blue" ng-disabled="formInduk.$invalid" ng-click="formIndukController.simpan()">Submit</button>
	        </div>
	    </div>
	</div>
<div class="cg-busy cg-busy-backdrop cg-busy-backdrop-animation ng-scope ng-hide" ng-show="$cgBusyIsActive()"></div><div class="cg-busy cg-busy-animation ng-scope ng-hide" ng-show="$cgBusyIsActive()"><div class="cg-busy-default-wrapper" style="position: absolute; inset: 0px;">

   <div class="cg-busy-default-sign">

      <div class="cg-busy-default-spinner">
         <div class="bar1"></div>
         <div class="bar2"></div>
         <div class="bar3"></div>
         <div class="bar4"></div>
         <div class="bar5"></div>
         <div class="bar6"></div>
         <div class="bar7"></div>
         <div class="bar8"></div>
         <div class="bar9"></div>
         <div class="bar10"></div>
         <div class="bar11"></div>
         <div class="bar12"></div>
      </div>

      <div class="cg-busy-default-text ng-binding">Loading...</div>

   </div>

</div></div></form>