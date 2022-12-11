@extends('partials.admin-panel.layout')
@section('title', 'الطلبات')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">الطلبات</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">لوحة التحكم</a>
                                    </li>
                                    <li class="breadcrumb-item active">الطلبات
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    @can('createOrder', App\Models\Order::class)
                        @livewire('create-order')
                    @endcan
                @endauth

            </div>

            <div class="content-body">
                @livewire('order')
            </div>

            @can('updateOrder', App\Models\Order::class)
                @livewire('edit-order')
            @endcan

        </div>
    </div>
    <!-- END: Content-->
@endsection
