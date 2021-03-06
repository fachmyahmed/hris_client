<div class="page-content">
  	<div id="portlet-config" class="modal hide">
      <div class="modal-header">
          <button data-dismiss="modal" class="close" type="button"></button>
           <h3>Widget Settings</h3>
      </div>
      <div class="modal-body">Widget settings form goes here</div>
  	</div>
  	<div class="clearfix"></div>
 	<div class="content">
	    <div class="page-title">
	        <i class="icon-custom-left"></i>
	        <h3>Kompetensi - <a href="<?=base_url($controller)?>"><?=$title?> - Input</a></h3> 
	    </div>
	    <div class="row">
	     	<div class="col-md-12">
		        <div class="grid simple">
		          	<div class="grid-body no-border">
		            <br/>
			            <div class="row-fluid">
					    	<?php
					    	$att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
					    	echo form_open_multipart($controller.'/add/', $att);
					   		?>
							<!-- <input type="hidden" id="form" value="form_penilaian"> -->
					   		<div class="row">
					            <div class="col-md-6">
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Periode</label>
					                    </div>
					                    <div class="col-md-9">
							            	<select class="select2" style="width:100%" id="comp_session_id" name="comp_session_id" required>
					                    		<option value="">-- Pilih Periode --</option>
							            		<?php foreach($periode as $u){?>
							            			<option value="<?=$u->id?>"><?=$u->year?></option>
							            		<?php } ?>
							            	</select>
					                    </div>
					                </div>
					            	<div class="row form-row">
						            	<div class="col-md-3">
					                        <label class="form-label text-right">Nama</label>
					                    </div>
					                    <div class="col-md-9">
							            	<select class="select2" style="width:100%" id="emp" name="nik">
							            		<option value="0">-- Pilih Karyawan --</option>
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select>
					                    </div>
					                </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('dept_div') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                        <input type="hidden" id="organization_id" name="organization_id" value="">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right"><?php echo lang('position') ?></label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="position" id="position" type="text"  class="form-control" placeholder="-" value="" disabled="disabled">
				                        <input type="hidden" id="position_id" name="position_id" value="">
				                      </div>
				                    </div>
					            </div>

					            <div class="col-md-6">
					        		<div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Nama Training</label>
				                      </div>
				                      <div class="col-md-9">
				                        <input name="nama_training" id="nama_training" type="text"  class="form-control" placeholder="-" value="">
				                      </div>
				                    </div>
				                    <div class="row form-row">
				                      <div class="col-md-3">
				                        <label class="form-label text-right">Tanggal Training</label>
				                      </div>
				                      <div class="col-md-9">
				                        <div id="datepicker_start" class="input-append date success no-padding">
				                          <input type="text" class="form-control" name="tgl_training" required>
				                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
				                        </div>
				                      </div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-12">
				                        	<h4 class="">Sasaran Training :</h4>
				                      	</div>
				                      	<div class="col-md-12">
					                        <textarea name="sasaran" class="form-control" placeholder="isi sasaran training disini....."></textarea>
					                   	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-12">
				                        	<h4 class="">Evaluasi Training :</h4>
				                      	</div>
				                      	<div class="radio radio-success">
				                      		<?php foreach($competency_evaluasi as $e){?>
			                      			<div class="col-md-6">
					                        	<input name="competency_evaluasi_training_id" id="<?=$e->id?>" name="competency_evaluasi_training_id" value="<?=$e->id?>" type="radio">
					                        	<label for="<?=$e->id?>"><?=$e->title?></label>
					                   		 </div>
					                        <?php } ?>
					               		 </div>
					               		<div class="col-md-12">
					                    	<input type="text" class="form-control" id="competency_evaluasi_training_lain" name="competency_evaluasi_training_lain" style="display: none" placeholder="Isi Evaluasi Training Lainnya Disini .....">
					                   	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                    	<div class="col-md-12">
				                        	<h4 class="">Metode Evaluasi :</h4>
				                      	</div>
				                      	<?php foreach($competency_metode as $m){?>
					                      	<div class="col-md-4">
						                        <div class="checkbox check-default">
							                      <input name="competency_metode_evaluasi_id[]" id="metode_<?=$m->id?>" value="<?=$m->id?>" type="checkbox">
							                      <label for="metode_<?=$m->id?>"><?=$m->title?></label>
							                    </div>
						                   	</div>
						                <?php } ?>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <!-- POINT EVALUASI -->
					        <div class="row">
					        	<div class="col-md-12">
					        		<div class="row form-row">
				                    	<div class="col-md-12">
				                        	<h4 class="">Point Evaluasi :</h4>
				                      	</div>
				                      	<div class="row col-md-12">
				                      		<div class="col-md-1">
				                      			Nilai:
				                      		</div>
				                      		<div class="col-md-2">
				                      			1 = Sangat Kurang
				                      		</div>
				                      		<div class="col-md-2">
				                      			2 = Kurang
				                      		</div>
				                      		<div class="col-md-2">
				                      			3 = Cukup
				                      		</div>
				                      		<div class="col-md-2">
				                      			4 = Baik
				                      		</div>
				                      		<div class="col-md-2">
				                      			5 = Sangat Baik
				                      		</div>
				                      	</div>
				                      	<div class="row">
								        	<div class="col-md-12">
								        		<table class="table table-bordered">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Pengetahuan</th>
															<th width="10%" class="text-center">Sebelum Training</th>
															<th width="10%" class="text-center">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_pengetahuan as $p) { ?>
															<tr>
																<td><?=$i++?></td>
																<td>
																	<?=$p->title?>
																	<input type="hidden" name="pengetahuan_point_id[]" value="<?=$p->id?>">
																</td>
																<td class="text-center">
																	<select class="select2" name="pengetahuan_point_sebelum[]">
																		<?php for ($j=1; $j < 6; $j++) { 
																			echo "<option value='$j'>$j</option>";
																		}
																		?>
																	</select>
																</td>
																<td class="text-center">
																	<select class="select2" name="pengetahuan_point_sesudah[]">
																		<?php for ($k=1; $k < 6; $k++) { 
																			echo "<option value='$k'>$k</option>";
																		}
																		?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Sikap</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;foreach ($competency_sikap as $s) { ?>
															<tr>
																<td><?=$i++?></td>
																<td>
																	<?=$s->title?>
																	<input type="hidden" name="sikap_point_id[]" value="<?=$s->id?>">
																</td>
																<td class="text-center">
																	<select class="select2" name="sikap_point_sebelum[]">
																		<?php for ($j=1; $j < 6; $j++) { 
																			echo "<option value='$j'>$j</option>";
																		}
																		?>
																	</select>
																</td>
																<td class="text-center">
																	<select class="select2" name="sikap_point_sesudah[]">
																		<?php for ($k=1; $k < 6; $k++) { 
																			echo "<option value='$k'>$k</option>";
																		}
																		?>
																	</select>
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>

												<table class="table table-bordered" id="tbl_keterampilan">
													<thead>
														<tr>
															<th width="5%">
											                    No.
															</th>
															<th width="75%">Keterampilan</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>

												<div class="col-md-12">
									        		<button id="btnAdd" type="button" class="btn btn-small btn-primary" title="Tambah Point Keterampilan" onclick="addKeterampilan('tbl_keterampilan')"><i class="icon-plus"></i> Tambah Point Keterampilan</button>
									        	</div>
									        	<br/>
									        	<br/>

												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="80%">Hasil / Output Pekerjaan</th>
															<th class="text-center" width="10%">Sebelum Training</th>
															<th class="text-center" width="10%">Sesudah Training</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><input type="text" class="form-control" name="output" placeholder="isi output/hasil Pekerjaan disini....."></td>
															<td class="text-center">
																<select class="select2" name="output_point_sebelum">
																	<?php for ($j=1; $j < 6; $j++) { 
																		echo "<option value='$j'>$j</option>";
																	}
																	?>
																</select>
															</td>
															<td class="text-center">
																<select class="select2" name="output_point_sesudah">
																	<?php for ($k=1; $k < 6; $k++) { 
																		echo "<option value='$k'>$k</option>";
																	}
																	?>
																</select>
															</td>
														</tr>
													</tbody>
												</table>
							                </div>
							            </div>
				                    </div>
					        	</div>
					        </div>
					        <!-- //POINT EVALUASI -->

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-8">
				                        	<h4 class="">Tindak Lanjut dari Evaluasi :</h4>
				                      	</div>

					                   	<div class="col-md-4">
				                        	<h4 class="">Realisasi Tanggal :</h4>
				                      	</div>
				                      	<div class="col-md-8">
					                        <textarea name="tindak_lanjut" class="form-control" placeholder="isi tindak lanjut dari evaluasi disini....."></textarea>
					                   	</div>
				                      	<div class="col-md-4">
					                        <div id="datepicker_start" class="input-append date success no-padding">
					                          <input type="text" class="form-control" name="realisasi_tgl" required>
					                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
					                        </div>
					                   	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-1">
				                        	<label class="form-label">HRD</label>
				                      	</div>

					                   	<div class="col-md-4">
				                        	<select class="select2" style="width:100%" id="hrd" name="hrd">
				                        		<option value="0">-- Pilih HRD --</option>
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select>
				                      	</div>
				                    </div>
					        	</div>
					        </div>

					        <div class="row">
					        	<div class="col-md-12">
				                    <div class="row form-row">
				                      	<div class="col-md-1">
				                        	<label class="form-label">HRD lainnya</label>
				                      	</div>

					                   	<div class="col-md-4">
				                        	<select class="select2" style="width:100%" id="hrd2" name="hrd2">
				                        		<option value="0">-- Pilih HRD --</option>
							            		<?php foreach($users as $u){?>
							            			<option value="<?=$u->nik?>"><?=$u->nik.' - '.$u->username?></option>
							            		<?php } ?>
							            	</select>
				                      	</div>
				                    </div>
					        	</div>
					        </div>
					        <hr/>
				            
			            	<div id="submit" class="form-actions">
			                 	<div class="pull-right">
			                    	<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
			                    	<a href="<?php echo site_url($controller) ?>"><button class="btn btn-white btn-cons" type="button"><?php echo lang('cancel_button') ?></button></a>
			                  	</div>
			                </div>
			              	<?php echo form_close(); ?>
			            </div>
		          	</div>
		        </div>
	      	</div>
	    </div>
  	</div>
</div>
