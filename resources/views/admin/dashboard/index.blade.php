@extends(ADMIN)
@push('title', translate('Dashboard'))

@section('content')
    <div class="ad-body-content">
        <div class="container-fluid">
            <div class="ad-body-content-inner">
                <div class="row g-2 g-sm-3 mb-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                    <div class="col">
                        <div class="ad-card card-hover">
                            <div class="ad-card-body px-20px py-3">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div>
                                        <p class="sub-title fs-14px mb-6px">Today’s Money</p>
                                        <p class="title fs-18px">$53,000 <span
                                                class="greenText fs-14px fw-semibold">+55%</span></p>
                                    </div>
                                    <div class="card-iconbox-sm2 primary-light-bg">
                                        <img src="{{ asset('assets/images/icons/empty-wallet-card.svg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="ad-card card-hover">
                            <div class="ad-card-body px-20px py-3">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div>
                                        <p class="sub-title fs-14px mb-6px">Today’s Users</p>
                                        <p class="title fs-18px">2,000 <span
                                                class="greenText fs-14px fw-semibold">+5%</span></p>
                                    </div>
                                    <div class="card-iconbox-sm2 danger-light-bg">
                                        <img src="assets/images/icons/empty-walletworld.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="ad-card card-hover">
                            <div class="ad-card-body px-20px py-3">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div>
                                        <p class="sub-title fs-14px mb-6px">New Clients</p>
                                        <p class="title fs-18px">+3,050 <span
                                                class="dangerText fs-14px fw-semibold">-14%</span></p>
                                    </div>
                                    <div class="card-iconbox-sm2 purple-light-bg">
                                        <img src="assets/images/icons/empty-wallet-doc.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="ad-card card-hover">
                            <div class="ad-card-body px-20px py-3">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div>
                                        <p class="sub-title fs-14px mb-6px">Total Sales</p>
                                        <p class="title fs-18px">$153,000<span
                                                class="greenText fs-14px fw-semibold">-8%</span></p>
                                    </div>
                                    <div class="card-iconbox-sm2 orange-light-bg">
                                        <img src="assets/images/icons/empty-wallet-shopping.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  g-sm-3 row-24px">
                    <div class="col-md-12 col-xl-6">
                        <div class="ad-card">
                            <div class="ad-card-body p-2">
                                <div class="chart-title px-2 mt-1">
                                    <p class="title fs-16px mb-6px">Sales overview</p>
                                    <p class="fs-12px"> <span class="greenText">(+5) more</span> in 2021</p>
                                </div>
                                <div id="selesChart"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-6">
                        <div class="ad-card mb-20px">
                            <div class="ad-card-body p-3">
                                <div class="column-chart-bd">
                                    <div id="userChart"></div>
                                </div>

                                <div class="active-users-area mt-3">
                                    <div class="user-title mb-10px">
                                        <p class="title fs-16px pb-10px">Active Users</p>
                                        <p class="grayText"><span class="greenText">(+23)</span> than last
                                            week</p>
                                    </div>

                                    <div
                                        class="row row-cols-2 row-cols-sm-4 row-cols-md-4 row-cols-lg-4 row-cols-xl-4 gx-5 gy-3">
                                        <div class="col">
                                            <div class="mb-6px d-flex gap-2 align-items-center">
                                                <div class="card-iconbox-small primary-light-bg">
                                                    <img src="assets/images/icons/empty-wallet-user.svg" alt="">
                                                </div>
                                                <p class="sub-title fs-12px">User</p>
                                            </div>
                                            <div>
                                                <h6 class="title fs-16px mb-10px">2,42m</h6>
                                                <div class="progress ad-bt-progress ad-bt-progress-sm" role="progressbar"
                                                    aria-label="Basic example" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-6px d-flex gap-2 align-items-center">
                                                <div class="card-iconbox-small danger-light-bg">
                                                    <img src="assets/images/icons/empty-walletworld.svg" alt="">
                                                </div>
                                                <p class="sub-title fs-12px">Clicks</p>
                                            </div>
                                            <div>
                                                <h6 class="title fs-16px mb-10px">2,42m</h6>
                                                <div class="progress ad-bt-progress ad-bt-progress-sm" role="progressbar"
                                                    aria-label="Basic example" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-6px d-flex gap-2 align-items-center">
                                                <div class="card-iconbox-small orange-light-bg">
                                                    <img src="assets/images/icons/empty-wallet-shopping.svg" alt="">
                                                </div>
                                                <p class="sub-title fs-12px">Sales</p>
                                            </div>
                                            <div>
                                                <h6 class="title fs-16px mb-10px">2,400$</h6>
                                                <div class="progress ad-bt-progress ad-bt-progress-sm" role="progressbar"
                                                    aria-label="Basic example" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-6px d-flex gap-2 align-items-center">
                                                <div class="card-iconbox-small purple-light-bg">
                                                    <img src="assets/images/icons/empty-wallet-items.svg" alt="">
                                                </div>
                                                <p class="sub-title fs-12px">Items</p>
                                            </div>
                                            <div>
                                                <h6 class="title fs-16px mb-10px">320</h6>
                                                <div class="progress ad-bt-progress ad-bt-progress-sm" role="progressbar"
                                                    aria-label="Basic example" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar" style="width: 85%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 row-24px">
                    <div class="col-md-6 col-xl-7 col-sm-12">
                        <div class="ad-card">
                            <div class="ad-card-body p-3">

                                <div class="d-flex align-items-center justify-content-between pb-1">
                                    <p class="fs-16px title">Check Table</p>
                                    <div class="dropdown ad-icon-dropdown">
                                        <button class="btn btn-secondary dropdown-toggle rotate-icon" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">View</a></li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Download</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table check-table">
                                        <thead>
                                            <tr>
                                                <th class="fs-12px">NAME</th>
                                                <th class="fs-12px">PROGRESS</th>
                                                <th class="fs-12px">QUANTITY</th>
                                                <th class="fs-12px">DATE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check1">
                                                        <label class="form-check-label" for="table-row-check1">
                                                            Horizon UI PRO
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>17.5%</td>
                                                <td>2.458</td>
                                                <td>24.Jan.2021</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check2">
                                                        <label class="form-check-label" for="table-row-check2">
                                                            Horizon UI Free
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>10.8%</td>
                                                <td>1.485</td>
                                                <td>12.Jun.2021</td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check3" checked>
                                                        <label class="form-check-label" for="table-row-check3">
                                                            Weekly Update
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>21.3%</td>
                                                <td>1.024</td>
                                                <td>5.Jan.2021</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check4" checked>
                                                        <label class="form-check-label" for="table-row-check4">
                                                            Venus 3D Asset
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>31.5%</td>
                                                <td>858</td>
                                                <td>7.Mar.2021</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check5" checked>
                                                        <label class="form-check-label" for="table-row-check5">
                                                            Marketplace
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>12.2%</td>
                                                <td>258</td>
                                                <td>17.Dec.2021</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check6" checked>
                                                        <label class="form-check-label" for="table-row-check6">
                                                            Marketplace
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>12.2%</td>
                                                <td>258</td>
                                                <td>17.Dec.2021</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="table-row-check7">
                                                        <label class="form-check-label" for="table-row-check7">
                                                            Horizon UI Free
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>10.8%</td>
                                                <td>1.485</td>
                                                <td>12.Jun.2021</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-5 col-sm-12">
                        <div class="ad-card">
                            <div class="ad-card-body p-3">
                                <div class="pie-chart-title d-flex justify-content-between mb-10px">
                                    <p class="fs-16px title">Your Pie Chart</p>
                                    <select class="ad-small-niceSelect right">
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                                <div class="pie-chart-area">
                                    <div class="chart-inner-content">
                                        <h4 class="title fs-20px">65%</h4>
                                        <p class="fs-12px sub-title">Total New <br> Customers</p>
                                    </div>

                                    <div class="d-flex justify-content-center align-items-center">
                                        <div id="pie1"></div>
                                    </div>
                                </div>
                                <div class="pie-chart-percentage  ad-card d-flex justify-content-center">
                                    <div class="pie-single-percentage text-center py-3">
                                        <p class="fs-12px sub-title"><span class="purple-bg"></span>Your files
                                        </p>
                                        <p class="fs-16px title">40%</p>
                                    </div>
                                    <div class="pie-single-percentage text-center py-3">
                                        <p class="fs-12px sub-title"><span class="orange-bg"></span>System</p>
                                        <p class="fs-16px title">25%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
