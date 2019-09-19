


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $title ; ?>

            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
<!--                        <h3><?php /*echo $studentCount ; */?></h3>
-->
                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
<!--                        <h3><?php /*echo count($maleCount)  ; */?><sup style="font-size: 20px"></sup></h3>
-->
                        <p>Male Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
<!--                        <h3><?php /*echo count($femaleCount) ; */?></h3>
-->
                        <p>Female Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph "></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
<!--                        <h3><?php /*echo ($signupsToday) ; */?></h3>
-->
                        <p>Sign Ups Today</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <div class="chart" id="studyLevel" style="height: 350px;"></div>
                        <br>
                        <br>
                        <br>
                        <div class="chart" id="topVideos" style="height: 350px;"></div>
                        <br>
                        <br>
                        <br>
                        <div class="chart" id="topBooks" style="height: 350px;"></div>
                    </ul>
                    <div class="tab-content no-padding">
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
                <!-- solid sales graph -->
                <div class="box box-solid bg-teal-gradient">

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Calendar -->
                <div class="box box-solid bg-green-gradient">
                    <div class="box-header">
                        <i class="fa fa-line-chart"></i>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <!--Student Classification -->
                        <div class="chart" id="gender" style="height: 350px;"></div>

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="chart" id="subscriptions" style="height: 350px;"></div>

                    <!-- /.box-body -->
                    <div class="box-footer text-black">
                        <br>
                        <br>
                        <br>
                        <div class="chart" id="subscription_types" style="height: 450px;"></div>
                    </div>
                </div>
                <!-- /.box -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!--/*bar graph for students by study level*/-->

