<style>
    .sb-sidenav-dark {
      background-color: #621299;
      color: rgba(255, 255, 255, 0.5);
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .sb-sidenav-dark .sb-sidenav-menu .sb-sidenav-menu-heading {
      color: #fff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link {
      color: #fff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link .sb-nav-link-icon {
      color: #fff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link .sb-sidenav-collapse-arrow {
      color: #fff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link:hover {
      color: #ebb1ff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active {
      color: #ebb1ff;
    }
    .sb-sidenav-dark .sb-sidenav-menu .nav-link.active .sb-nav-link-icon {
      color: #ebb1ff;
    }
    .sb-sidenav-dark .sb-sidenav-footer {
        color: #fff;
      background-color: #621299;
    }

</style>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Dashboard

                            </a>
                            <?php
                            if($_SESSION['vartype'] == 'admin')
                            {

                            ?>
                            <div class="sb-sidenav-menu-heading">Management</div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupervisor" aria-expanded="false" aria-controls="collapseSupervisor">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></i></div>
                                    Supervisors
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseSupervisor" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="register.php">Add Supervisors</a>
                                        <a class="nav-link" href="viewsupervisors.php">View Supervisors</a>
                                        <a class="nav-link" href="orgchart.php">View Teams</a>
                                    </nav>
                                </div>
                            <?php 
                            }
                            ?>

                            <?php
                            if($_SESSION['vartype'] == 'admin')
                            {
                            ?>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></i></div>
                                    Employees
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="registeremployee.php">Add Employee</a>
                                        <a class="nav-link" href="viewemployees.php">View Employees</a>
                                    </nav>
                                </div>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a class="nav-link " href="orgchart.php">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    View Teams
                                </a>
                                
                            <?php
                            }
                            ?>

                            <div class="sb-sidenav-menu-heading">Productivity</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Workforce Glance
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">

                                    <a class="nav-link" href="recordhours.php">Set Productivity Level</a>
                                    <a class="nav-link" href="viewproductivity.php">View Productivity</a>
                                    <!--<a class="nav-link" href="weeklyreport.php">Weekly Report</a>-->
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="prodchart.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts and Measures
                            </a>
                            <div class="sb-sidenav-menu-heading">Record</div>
                            <a class="nav-link" href="historylog.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                History Log
                            </a>
                        </div>
                    </div>

                    <?php
                            if($_SESSION['vartype'] == 'supervisor')
                            {
                            ?>
                            <div class="sb-sidenav-footer">
                                <div class="small">Logged in as:</div>
                                <?php
                                echo $_SESSION['fullname'];
                                ?>
                                <div class="small">SUPERVISOR</div>
                            </div>
                    <?php 
                            }
                            else
                            {
                    ?>
                            <div class="sb-sidenav-footer">
                                <div class="small">Logged in as:</div>
                                Admin
                            </div>
                    <?php 
                            }
                    ?>

                </nav>
            </div>


















