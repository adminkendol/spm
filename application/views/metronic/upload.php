<!--
<!doctype html>
<html>
    <head>
        <title>SPM</title>
        <!--<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css') ?>"/>-->
    <!--    <style>
            body{
                padding: 15px
            }
            .wrapper{
                width: 600px
            }
            form p{
                margin: 5px 0px;
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <h4>SPM</h4>
            <?php
            echo form_open_multipart($action);

            echo '<div class="form-group">';
            echo '<label>Judul ' . form_error('judul') . '</label>'; // show error judul
            echo form_input('judul', $judul, 'class="form-control" placeholder="Judul"');
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label>Excel ' . $error . '</label>'; // show error upload
            echo form_upload('userfile');
            echo '</div>';

            echo form_submit('mysubmit', 'Upload', 'class="btn btn-primary"');
            echo form_close();
            ?>
        </div>
    </body>
</html>
-->
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green-haze">
                    <i class="icon-settings font-green-haze"></i>
                    <span class="caption-subject bold uppercase"> Upload Form</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only blue" href="javascript:;"><i class="icon-cloud-upload"></i></a>
                    <a class="btn btn-circle btn-icon-only green" href="javascript:;"><i class="icon-wrench"></i></a>
                    <a class="btn btn-circle btn-icon-only red" href="javascript:;"><i class="icon-trash"></i></a>
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!--<form role="form" class="form-horizontal">-->
                <form role="form" class="form-horizontal" action="<?php echo base_url();?>upload/get_file/" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <label class="col-md-2 control-label" for="form_control_1">Excel file</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control" id="form_control_1" name="file">
                                <div class="form-control-focus"> </div>
                            </div>
                        </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="button" class="btn default">Cancel</button>
                                <button type="submit" class="btn blue">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php if($show==1){ ?>
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Data Preview</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active"><input type="radio" name="options" class="toggle" id="option1">Actions</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm"><input type="radio" name="options" class="toggle" id="option2">Settings</label>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                    <thead>
                        <tr class="">
                            <th> Area </th>
                            <th> Parameter </th>
                            <th> Telkomsel </th>
                            <th> Xl </th>
                            <th> Indosat </th>
                            <th> Three </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php for($i=0;$i<count($response);$i++){ ?>
                        <tr>
                            <td><?php echo $response[$i]['area'];?></td>
                            <td>
                                <?php for($a=0;$a<count($response[$i]['data']);$a++){ 
                                    echo $response[$i]['data'][$a]['parameter']."<br>"; 
                                } ?>
                            </td>
                            <td><?php for($a=0;$a<count($response[$i]['data']);$a++){ 
                                    echo $response[$i]['data'][$a]['telkomsel']."<br>"; 
                                } ?></td>
                            <td><?php for($a=0;$a<count($response[$i]['data']);$a++){ 
                                    echo $response[$i]['data'][$a]['xl']."<br>"; 
                                } ?></td>
                            <td><?php for($a=0;$a<count($response[$i]['data']);$a++){ 
                                    echo $response[$i]['data'][$a]['indosat']."<br>"; 
                                } ?></td>
                            <td><?php for($a=0;$a<count($response[$i]['data']);$a++){ 
                                    echo $response[$i]['data'][$a]['three']."<br>"; 
                                } ?></td>
                        </tr>
                    <?php } ?>    
                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>                
                    