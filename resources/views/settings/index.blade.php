@extends('layouts.backend');
@section('content')
    <div class="content">
        <div class="col-md-12">
            <!-- Block Tabs Default Style -->
            <div class="block">
                <form id="saveSetting" method="post" action="{{ action('SettingController@SettingInvoiceSave') }}">
                    @csrf
                    <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#btabs-static-home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-static-profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#btabs-invoice">Fatura</a>
                        </li>

                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="#btabs-static-settings">
                                <i class="si si-settings"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="block-content tab-content">
                        <div class="tab-pane active" id="btabs-static-home" role="tabpanel">
                            <h4 class="font-w400">Home Content</h4>
                            <p>...</p>
                        </div>
                        <div class="tab-pane" id="btabs-static-profile" role="tabpanel">
                            <h4 class="font-w400">Profile Content</h4>
                            <p>...</p>
                        </div>
                        <div class="tab-pane" id="btabs-static-settings" role="tabpanel">
                            <h4 class="font-w400">Settings Content</h4>
                            <p>...</p>
                        </div>
                        <div class="tab-pane" id="btabs-invoice" role="tabpanel">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Hizmet Satırı KDV oranı</label>
                                <div class="col-md-3">
                                    <input type="number" class="form-control" name="invoiceServiceTax" value="{{ Setting::get('invoice.ServiceTax') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <button class="btn btn-sm btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
            <!-- END Block Tabs Default Style -->
        </div>
    </div>
@stop
