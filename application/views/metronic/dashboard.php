<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<h3 class="page-title"> Dashboard <small>dashboard & statistics</small></h3>
<!--<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349">0</span>
                </div>
                <div class="desc"> Closed </div>
            </div>
            <a class="more" href="javascript:;"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12">0</span>
                </div>
                <div class="desc"> Opened </div>
            </div>
            <a class="more" href="javascript:;"> View more
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    
</div>-->
<div class="row">
    <div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Dashboard</span>
                    &nbsp;
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">
                    <thead>
                        <tr class="">
                            <th> Area </th>
                            <th> Regional </th>
                            <th> BBC </th>
                            <th> Problem Event</th>
                            <th> July </th>
                            <th> August </th>
                            <th> October </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($datas as $dt){ ?>
                        <tr>
                            <td><?php echo $dt->area; ?></td>
                            <td><?php echo $dt->regional; ?></td>
                            <td><?php echo $dt->bbc; ?></td>
                            <td><?php echo $dt->p_service; ?></td>
                            <td><?php echo number_format((float)$dt->july*100, 2, '.', '')."%"; ?></td>
                            <td><?php echo number_format((float)$dt->august*100, 2, '.', '')."%"; ?></td>
                            <td><?php echo number_format((float)$dt->october*100, 2, '.', '')."%"; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>