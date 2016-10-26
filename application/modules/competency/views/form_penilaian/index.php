<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
            <h3>Daftar Form Penilaian Karyawan</span></h3> 
        </div>
        <a href="<?=base_url($ci->controller.'/input')?>"><button type="button" class="btn btn-primary" title="Klik disini untuk membuat pengajuan baru"><i class="icon-plus"></i> Buat Form Penilaian Baru</button><br/><br/></a>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-full-width " id="table" style="width: 100%;">
                                <thead>
                                     <tr>
                                      <th width="5%">NIK</th>
                                      <th width="15%">Nama</th>
                                      <th width="10%">Jabatan</th>
                                      <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>