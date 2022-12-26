<!DOCTYPE html>
<html class="loading {{ websiteMode() }}" lang="en" data-textdirection="rtl">

<!-- BEGIN: Head-->

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title></title>

    <!-- BEGIN: Vendor CSS-->


    <style>
        .navbar-floating .navbar-container:not(.main-menu-content) {
            padding: 0.8rem 1rem;
        }

        .navbar-floating .header-navbar-shadow {
            display: block;
            background: linear-gradient(180deg, rgba(248, 248, 248, 0.95) 44%, rgba(248, 248, 248, 0.46) 73%, rgba(255, 255, 255, 0));
            padding-top: 2.2rem;
            background-repeat: repeat;
            width: 100%;
            height: 102px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 11;
        }

        .vertical-layout .header-navbar .navbar-container ul.navbar-nav li.dropdown .dropdown-menu {
            top: 41px !important;
            right: 0;
        }

        .dark-layout .header-navbar-shadow {
            background: linear-gradient(180deg, rgba(22, 29, 49, 0.9) 44%, rgba(22, 29, 49, 0.43) 73%, rgba(22, 29, 49, 0));
        }

        .navbar>.container,
        .navbar>.container-fluid,
        .navbar>.container-xs,
        .navbar>.container-sm,
        .navbar>.container-md,
        .navbar>.container-lg,
        .navbar>.container-xl,
        .navbar>.container-xxl {
            display: flex;
            flex-wrap: inherit;
            align-items: center;
            justify-content: space-between;
        }

        .dark-layout .content-header-left .breadcrumbs-top .content-header-title {
            color: #d0d2d6;
            border-color: #3b4253;
        }

        .content-header .breadcrumb {
            padding-left: 1rem;
        }
    </style>

    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css-rtl/themes/semi-dark-layout.css') }}"> --}}
</head>



<body class="vertical-layout navbar-floating footer-static">



    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">المبيعات</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">لوحة التحكم</a>
                                    </li>
                                    <li class="breadcrumb-item active">المبيعات
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">

                    <!-- list and filter start -->
                    <section id="basic-datatable">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <table class="datatables-basic table">
                                        <thead>
                                            <tr>
                                                <th>رقم البيع</th>
                                                <th>التاريخ</th>
                                                <th>المدينة</th>
                                                <th>نوع العقار</th>
                                                <th>رقم الارض</th>
                                                <th>مساحة الأرض</th>
                                                <th>سعر الأرض</th>
                                                <th>نوع العملاء</th>
                                                <th>الفرع</th>
                                                <th>تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>QTF-SELL1011-USR9</td>
                                                <td> 10-10-2022</td>
                                                <td> الرياض </td>
                                                <td> ارض</td>
                                                <td>512</td>
                                                <td>100 متر</td>
                                                <td>1000 ريال</td>
                                                <td>حكومى</td>
                                                <td>مكة</td>
                                                <td>
                                                    <div class="d-inline-flex">
                                                        <a href="view-sell.html" class="item-view">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:;" class="item-edit"
                                                            data-bs-target="#editUser" data-bs-toggle="modal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button class="btn item-edit" style="padding:0;color:#EA5455 ">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal to add new record -->

                    </section>
                    <!-- list and filter end -->
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-start d-block d-md-inline-block mt-25">حقوق الملكية &copy; 2022
                <a class="ms-25" href="#" target="_blank"></a>
                <span class="d-none d-sm-inline-block">, جميع الحقوق محفوظة</span>
            </span>
            <span class="float-md-end d-none d-md-block">صُنع بحب
                <i data-feather="heart"></i>
            </span>
        </p>
    </footer>

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
</body>

</html>
