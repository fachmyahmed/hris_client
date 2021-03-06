<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
	    <div id="container">
	    	<div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form Keterangan Tidak <a href="<?php echo site_url('form_absen')?>"><span class="semi-bold">Absen</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <!--<form class="form-no-horizontal-spacing" id="formaddabsen" action="<?php echo site_url('form_absen/add')?>">--> 
              <?php 
                $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
                echo form_open('form_absen/add', $att)?>;
                <div class="row column-seperation">
                  <div class="col-md-12">    
                    <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
                    
                     <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama Karyawan</label>
                      </div>
                      <div class="col-md-9">
                      <?php 
                      if(is_admin()){?>
                        <select id="emp" class="select2" style="width:100%" name="emp">
                          <?php
                          foreach ($all_users->result() as $u) :
                            $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                            <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username.' - '.get_nik($u->id); ?></option>
                          <?php endforeach; ?>
                        </select>
                      <?php }else{?>
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama Karyawan" value="<?php echo get_name($sess_id)?>" disabled="disabled">
                        <input name="emp" id="emp" type="hidden" value="<?php echo $sess_id?>">
                      <?php } ?>
                      </div>
                    </div>

                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">No</label>
                      </div>
                      <div class="col-md-9">
                        <input name="form3LastName" id="form3LastName" type="text"  class="form-control" placeholder="Nama" value="<?php echo $absen_id?>" disabled="disabled">
                      </div>
                    </div>
                    
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Tanggal</label>
                      </div>
                      <div class="col-md-8">
                        <div class="input-append date success no-padding">
                          <input type="text" class="form-control" name="date_tidak_hadir" required>
                          <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> 
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="organization" id="organization" type="text"  class="form-control" placeholder="Organization" value="" disabled="disabled">
                      </div>
                    </div>
                    <input name="position-group" id="position-group" type="hidden"  class="form-control" placeholder="" value="" disabled="disabled">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                          <?php 
                          if($keterangan_absen->num_rows()>0){
                            foreach($keterangan_absen->result() as $row):?>
                            <input id="tidak_absen_in_<?php echo $row->id?>" type="radio" name="keterangan" value="<?php echo $row->id?>" required>
                            <label for="tidak_absen_in_<?php echo $row->id?>"><?php echo $row->title?></label>
                          <?php endforeach;}else{?>
                            <input id="tidak_absen_in" type="radio" name="keterangan" value="0">
                            <label for="tidak_absen_in">No Data</label>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Alasan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="alasan" id="alasan" type="text"  class="form-control" placeholder="Alasan" value="" required>
                      </div>
                    </div>
                    <?php if(is_admin()){?>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Izin Potong Cuti</label>
                      </div>
                      <div class="col-md-9">
                        <div class="radio">
                          <input id="potong_cuti_1" type="radio" name="potong_cuti" value="1">
                          <label for="potong_cuti_1">Ya</label>
                          <input id="potong_cuti_0" type="radio" name="potong_cuti" value="0" checked>
                          <label for="potong_cuti_0">Tidak</label>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    
                    <div id="atasan">
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="bold form-label text-right"><?php echo 'Approval' ?></label>
                      </div>
                    </div>
                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right"><?php echo 'Atasan Langsung' ?></label>
                        </div>
                        <div class="col-md-9">
                          <?php
                            $style_up='class="select2" style="width:100%" id="atasan1"';
                                echo form_dropdown('atasan1',array('0'=>'- Pilih Atasan Langsung -'),'',$style_up);
                          ?>
                        </div>
                      </div>

                     <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right"><?php echo 'Atasan Tidak Langsung (Optional)' ?></label>
                        </div>
                        <div class="col-md-9">
                          <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                              <option value="0">- Pilih Atasan Tidak Langsung -</option>
                          </select>
                        </div>
                      </div>

                      <div class="row form-row">
                        <div class="col-md-3">
                          <label class="form-label text-right"><?php echo 'Atasan Lainnya (Optional)' ?></label>
                        </div>
                        <div class="col-md-9">
                          <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                              <option value="0">- Pilih Atasan Lainnya -</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-actions">
                  <div class="pull-right">
                    <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Save</button>
                    <a href="<?php echo site_url('form_absen')?>"><button class="btn btn-white btn-cons" type="button">Cancel</button></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>  
	<!-- END PAGE --> 