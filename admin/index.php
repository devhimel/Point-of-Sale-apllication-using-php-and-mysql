<?php include "includes/header.php"; ?>

    <div class="page-content">
        <?php display_message(); ?>
        <div class="container-fluid">
            <!-- start breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
            <!-- end breadcrumb -->
            <!-- start greeting -->
            <h4>Welcome back <span
                        class="text-primary"><?= $_SESSION['loggedInUser']['first_name'].' '.$_SESSION['loggedInUser']['last_name']; ?></span>
            </h4>
            <!-- end greeting -->
            <!-- start Card -->
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Sales</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Purchases</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Sales Return</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Purchases Return</h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Card -->
            <!-- start recent sales -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-title mb-0">
                            <h5 class="ps-3 pt-3 mb-0">Recent Sales</h5>
                        </div>
                        <hr>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-responsive" id="recentSalesTable">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Grand Total</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Payment Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-title mb-0">
                            <h5 class="ps-3 pt-3 mb-0">Top 5 Customers</h5>
                        </div>
                        <hr>
                        <div class="card-body pt-0">

                        </div>
                    </div>
                </div>
            </div>
            <!-- end recent sales -->

        </div>
    </div>


<?php include "includes/footer.php"; ?>