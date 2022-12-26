@extends('partials.admin-panel.layout')
@section('title', 'المبيعات')
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

                {{-- @auth
                    @can('createSale', App\Models\Sale::class)
                        @livewire('create-sale')
                    @endcan
                @endauth --}}

            </div>

            <div class="content-body">
                @livewire('sales')
            </div>
            {{--
            @can('updateSale', App\Models\Sale::class)
                @livewire('edit-sale')
            @endcan --}}

        </div>
    </div>
    <!-- END: Content-->
@endsection
