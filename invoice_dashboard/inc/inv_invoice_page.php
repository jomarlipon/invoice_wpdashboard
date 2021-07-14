<div class="invoice-wrap">
    <div class="title-wrap">
        <h1>
            Invoices
        </h1>
    </div>
    <div class="filter-wrap">
        <div cass="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="status-filter">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a href="#" class="all active" data-invstatus="all" data-bs-toggle="tab" data-bs-target="#inv-all">All</a></li>
                            <li class="nav-item"><a href="#" class="ongoing" data-invstatus="ongoing" data-bs-toggle="tab" data-bs-target="#inv-ongoing">Ongoing</a></li>
                            <li class="nav-item"><a href="#" class="verified" data-invstatus="verified" data-bs-toggle="tab" data-bs-target="#inv-verified">Verified</a></li>
                            <li class="nav-item"><a href="#" class="pending" data-invstatus="pending" data-bs-toggle="tab" data-bs-target="#inv-pending">Pending</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="date-search-paid float-end">
                        <div class="class=date">Start Date and EndDate</div>
                        <div class="searchbox input-prepend">
                        
                                <span class="spansearch"><i class="fa fa-search fa-lg"></i></span>
                                <input type="text" id="searchInvoice" placeholder="Search">
                        </div>
                        <div class="markaspaid"><div class="button-markpaid">Mark as paid</div></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="image-overlayload">
                        <img src="<?php echo plugins_url()?>/invoice_dashboard/assets/images/loading-image.svg" alt="Invoice Dashboard loading">
                    </div>
                    <div class="invoices-wrap">
                        <table class="table" id="invtable">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Restaurant</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Fees</th>
                                    <th scope="col">Transfer</th>
                                    <th scope="col">Orders</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="tab-content inv-contentTable">
                                <!-- <tr>
                                    <td class="" id="#divInvContent">
                                        <div class="tab-content" id="#divInvContent">
                                            <div class="tab-pane fade show active" id="inv-all" role="tabpanel" aria-labelledby="inv-all-tab"></div>
                                            <div class="tab-pane fade" id="inv-ongoing" role="tabpanel" aria-labelledby="inv-ongoing-tab">...Ongoing</div>
                                            <div class="tab-pane fade" id="inv-verified" role="tabpanel" aria-labelledby="inv-verified-tab">...verified</div>
                                            <div class="tab-pane fade" id="inv-pending" role="tabpanel" aria-labelledby="inv-pending-tab">...pending</div>
                                        </div>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>