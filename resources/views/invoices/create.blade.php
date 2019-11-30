@extends('layouts.backend');

@section('content')
    <div class="content">
        <form id="newInvoiceHeader" name="newInvoiceHeader">
            <div class="block" id="invoice-header">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Yeni Fatura</h3>

                </div>
                <div class="block-content" id="invoice-content">
                    <div class="errorArea"></div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label class="col-12">Firma Adı</label>
                            <div class="input-group group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                        Firma Ara
                                    </button>
                                </div>
                                <input id="company" name="company" type="text" class="form-control" required
                                       placeholder="Firma Ara"/>
                                <div class="input-group-append">
                                    <button id="button-newCurrentAccount" type="button" class="btn btn-secondary">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <input id="companyId" name="companyId" type="hidden"/>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <div class="form-group">
                                    <label for="invoiceDate">Fatura Tarihi</label>
                                    <input type="text" class="form-control bg-white" id="invoiceDate" name="invoiceDate"
                                           required
                                           value="{{ Carbon\Carbon::now()->format('d-m-Y') }}">
                                </div>
                                <div class="form-group">
                                    <label for="invoiceNumber">Fatura No</label>
                                    <input type="text" class="form-control bg-white" id="invoiceNumber"
                                           name="invoiceNumber" required
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="currencyCode">Döviz</label>
                                    <select name="currencyCode" id="currencyCode" class="form-control">
                                        <option value="" selected>Döviz Yok</option>
                                        @foreach($currencyCodes as $codes)
                                            <option value="{{ $codes->code }}">{{ $codes->code }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content bg-body-light font-size-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <button type="submit" id=""
                                        class="btn btn-sm btn-square btn-primary min-width-125 mb-10">
                                    <i class="fa fa-plus-circle"></i> Yeni Fatura
                                </button>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </form>
    </div>
    <!-- -->
    <div class="content">
        <!-- Invoice -->

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title invoiceText">#INV0015</h3>
                <input name="invoiceCode" id="invoiceCode" value="" type="text">
                <input name="invoiceCurrencyCode" id="invoiceCurrencyCode" value="" type="text">
                <input name="invoiceCurrency" id="invoiceCurrency" value="" type="text">
                <input name="invoiceId" id="invoiceId" value="" type="text">

                <div class="block-options">
                    <select name="currencyCodeChange" id="currencyCodeChange" class="form-control">
                        <option value="" selected>Döviz Yok</option>
                        @foreach($currencyCodes as $codes)
                            <option value="{{ $codes->code }}">{{ $codes->code }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn-block-option" onclick="Codebase.helpers('print-page');">
                        <i class="si si-printer"></i> Print Invoice
                    </button>
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                            data-action="fullscreen_toggle"></button>
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle"
                            data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <div class="row my-20">
                    <!-- Company Info -->
                    <div class="col-6">
                        <p class="h3">Company</p>
                        <address>
                            Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ltd@example.com
                        </address>
                    </div>
                    <!-- END Company Info -->

                    <!-- Client Info -->
                    <div class="col-6 text-right">
                        <p class="h3 invoiceCompany">Client</p>
                        <address>
                            <span class="address">Street Address</span>
                        </address>
                    </div>
                    <!-- END Client Info -->
                </div>
                <!-- END Invoice Info -->

                <!-- Table -->
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover" id="tab_logic">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 2%"> #</th>
                            <th class="text-center" style="width: 20%"> Ürün Adı</th>
                            <th class="text-center" style="width: 10%"> Adet</th>
                            <th class="text-center" style="width: 10%"> Birim Fiyat</th>
                            <th class="text-center" style="width: 10%"> KDV</th>
                            <th class="text-center" style="width: 13%"> Tutar</th>
                            <th class="text-center" style="width: 13%"> İ. Tutar</th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr id='addr0'>
                            <td>1</td>
                            <td>
                                <input type="text" name='product[]' placeholder='ürün Adı Girin'
                                       class="form-control form-control-sm productAutoComplet"/>
                            </td>
                            <td>
                                <input type="number" name='qty[]' placeholder='Adet' class="form-control form-control-sm qty"
                                       step="0" min="0"/>
                            </td>

                            <td>
                                <input type="number" name='price[]' placeholder='Birim Tutar'
                                       class="form-control form-control-sm price" step="0.00" min="0"/>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="number" name='tax[]' placeholder='KDV' class="form-control form-control-sm tax"
                                           step="0.00" min="0" readonly />
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-secondary taxValues" name="taxValue[]"></button>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <input type="number" name='total[]' placeholder='0.00' class="form-control form-control-sm total"
                                       readonly/>
                            </td>
                            <td>
                                <input type="number" name='discountTotal[]' placeholder='0.00' class="form-control form-control-sm discountTotal"
                                       readonly/>
                            </td>


                        </tr>
                        <tr id='addr1'></tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-10 mb-10">
                        <button id="add_row" class="btn btn-success pull-left">Satır Ekle</button>
                        <button id='delete_row' class="pull-right btn btn-warning">Satır Sil</button>
                    </div>
                </div>

                <div class="table-responsive push">
                    <table class="table table-borderless" id="tab_logic_total">
                        <tbody>
                        <tr>
                            <th style="width: 10%"></th>
                            <th style="width: 50%"></th>

                            <th class="text-center" style="width: 15%">Toplam</th>
                            <td class="text-center" style="width: 15%">
                                <input type="number" name='sub_total'
                                       placeholder='0.00'
                                       class="form-control" id="sub_total"
                                       readonly/></td>

                        </tr>
                        <tr>
                            <th style="width: 10%"></th>
                            <th></th>

                            <th class="text-center">İndirim</th>
                            <td class="text-center">
                                <input type="number" name='total_discount' id="total_discount"
                                       placeholder='0.00' class="form-control"/>
                            </td>

                        </tr>
                        <tr>
                            <th style="width: 10%"></th>
                            <th></th>

                            <th class="text-center">KDV</th>
                            <td class="text-center">
                                <div class="input-group">
                                    <input type="number" step="0.00" class="form-control" id="total_tax" name="total_tax"
                                         readonly  placeholder="0">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary">  %</button>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        <tr>
                            <th style="width: 10%"></th>
                            <th></th>


                        </tr>
                        <tr>
                            <th style="width: 10%"></th>
                            <th></th>

                            <th class="text-center">Ara Toplam</th>
                            <td class="text-center">
                                <input type="number" name='total_amount' id="total_amount"
                                       placeholder='0.00' class="form-control" readonly/>
                            </td>

                        </tr>

                        <tr>
                            <th style="width: 10%"></th>
                            <th></th>

                            <th class="text-center">Toplam</th>
                            <td class="text-center">
                                <input type="number" name='total' id="total"
                                       placeholder='0.00' class="form-control" readonly/></td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Table -->

            </div>


            <!-- END Invoice -->
        </div>
        <!-- -->
        <!-- From Current Account Modal -->
        <div class="modal fade" id="modal-createAccount" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="form-createAccount" name="form-createAccount" method="post">
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark">
                                <h3 class="block-title" id="nestedName">Yeni Cari Kart</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                            aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="block-content">

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="code">Kodu</label>
                                        <input type="text" v-model="account.code" id="code" name="code"
                                               class="form-control"
                                               minlength="3" maxlength="5" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="company">Firma Adı</label>
                                    <input type="text" v-model="account.company" id="company" name="company"
                                           class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="user">Yetkili</label>
                                    <input type="text" v-model="account.user" id="user" name="user" class="form-control"
                                           required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="vat">Telefonu</label>
                                        <input type="text" v-model="account.telephone" name="telephone" id="telephone"
                                               required
                                               class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vat">Email</label>
                                        <input type="text" v-model="account.email" id="email" name="email" required
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="tax">Vergi No</label>
                                        <input type="number" v-model="account.tax" id="tax" class="form-control"
                                               name="tax"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vat">Vergi Dairesi</label>
                                        <input type="text" v-model="account.taxname" id="vat" class="form-control"
                                               name="taxname" required>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="vat">Adres</label>
                                    <textarea type="text" v-model="account.address" id="address" name="address" required
                                              class="form-control"></textarea>
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-alt-success">
                                <i class="fa fa-check"></i> Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END From Left Modal -->
    </div>
@stop
@section('css_after')
    <link rel="stylesheet" href="{{asset('js/plugins/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@stop
@section('js_after')
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script
        src="{{ asset('js/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.tr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/localization/messages_tr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('js/invoices.js') }}"></script>
    <script>
        function calc() {
            $('#tab_logic tbody tr').each(function (i, element) {
                var html = $(this).html();
                if (html !== '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);

                    var taxValue = $(this).find('.taxValues').text();
                 //   console.log(taxValue);
                    $(this).find('.tax').val(((qty * price) * taxValue) / 100);


                    discount = parseFloat($('#total_discount').val());

                    $(this).find('.discountTotal').val(qty * price);

                    if(discount> 0){
                        count = $('#tab_logic tbody').find('.total').length;
                        console.log('Count', count);
                        per_discount = discount / count;

                        $(this).find('.discountTotal').val(((qty * price) - per_discount).toFixed(2));
                        $(this).find('.tax').val(((((qty * price)-per_discount) * taxValue) / 100).toFixed(2));

                    }

                    calc_total();
                }
            });
        }

        function calc_total() {

            discount = $('#total_discount').val();
            total = 0;

            $('.discountTotal').each(function () {
                total += parseFloat($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));

            tax= 0;
            $('.tax').each(function () {
                tax += parseFloat($(this).val());
            });
            $('#total_tax').val(tax);

            subTotal = $('#sub_total').val();
            totalTax = $('#total_tax').val();
           // console.log('subTotal :' +subTotal + ' Total tax : '+totalTax);
            $('#total_amount').val(parseFloat(subTotal) + parseFloat(totalTax));

         //

        }

        $(document).ready(function () {

            //Variable Global

            let currency;
            let currencyCode;
            let invoiceId;

            //Invoice Action
            let i = 1;
            $("#add_row").click(function () {
                let b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function () {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function () {
                calc();
            });
            // $('#total_tax').on('keyup change', function () {
            //     calc_total();
            // });
            $('#total_discount').on('keyup change', function () {

                totalDiscount = $('#total_discount').val();
                count = $('#tab_logic tbody').find('.total').length;
                per_discount = (totalDiscount / count).toFixed(2);

                $('#tab_logic tbody tr td:nth-child(6)').each(function () {
                    total = $(this).find('.total').val();
                    $(this).next().find('.discountTotal').val(total - per_discount);
                    taxValue = $(this).prev().find('.taxValues').text();

                    tax = ((total-per_discount) * taxValue) / 100;

                    console.log(total ,tax, taxValue);

                  // console.log($(this).prev().find('input'));
                   $(this).prev().find('input').val(tax);


                });
                calc_total();
            });

            $('body')
                .on('focus', '.productAutoComplet', function () {
                    $(this).autocomplete({
                        source: function (request, response) {
                            $.ajax({
                                url: '/dashboard/stock/getCurrentStock',
                                data: {
                                    term: request.term
                                },
                                dataType: "json",
                                success: function (data) {
                                  //  console.log(data);
                                    var resp = $.map(data, function (obj) {
                                        return {
                                            label: obj.name,
                                            value: obj.id,
                                            tax:obj.tax
                                        }
                                    });

                                    response(resp);
                                }

                            })

                        }, select: function (event, ui) {
                            $(this).val(ui.item.label);
                            $(this).parent().siblings().eq(3).children('.input-group').find('button').text(ui.item.tax);

                            return false;
                        },
                        minLength: 3
                    });
                })
                .on('change','#currencyCodeChange', function () {
                    var code = this.value
                    var date = $('#invoiceDate').val();
                    alert(date);
                });

            $('#invoiceDate').datepicker({
                language: 'tr',
                format: 'dd-mm-yyyy'
            });
            $("#company").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "/dashboard/invoices/getCurrentAccount",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            var resp = $.map(data, function (obj) {
                                return {
                                    label: obj.company,
                                    value: obj.id
                                }
                            });

                            response(resp);
                        },

                    });


                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $('#companyId').val(ui.item.value);
                    return false;
                },
                minLength: 3
            });

            //
            // $('#save-Invoice').on('click', function (e) {
            //     if($('#company').val() === '' || $('#companyId').val() === '' || $('#invoiceDate').val() === '' || $('#invoiceNumber').val() === '' ){
            //         //Codebase.blocks('#invoice-header', 'state_loading')
            //         Codebase.helpers('notify', {
            //             align: 'right',             // 'right', 'left', 'center'
            //             from: 'top',                // 'top', 'bottom'
            //             type: 'danger',               // 'info', 'success', 'warning', 'danger'
            //             icon: 'fa fa-info mr-5',    // Icon class
            //             message: 'Lütfen Tüm alanları doldurun!'
            //         });
            //     }
            //
            // });
            //
            $('#button-newCurrentAccount').on('click', function (e) {
                $('#modal-createAccount').modal('show');
            });
            //UTILS
            $('#code').on('keyup', function () {
                this.value = this.value.toUpperCase('tr-TR');
            });
            $('form#form-createAccount').validate({
                submitHandler: function (form) {
                    let data = $(form).serialize();
                    $.ajax({
                        url: '/dashboard/current-account/create',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                            //console.log(response);
                            if (response.message === 'Success') {

                                $('#company').val(response.data.company);
                                $('#companyId').val(response.data.id);
                                $('#modal-createAccount').modal('hide');


                            }
                        }
                    }).done(function () {
                        $(form)[0].reset();
                    });
                    return false;
                }
            });
            $('form#newInvoiceHeader').validate({
                errorPlacement: function (error, element) {

                    if (element.parent().hasClass('input-group')) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function (form) {
                    let data = $(form).serialize();


                    $.ajax({
                        url: '/dashboard/invoices/saveInvoiceHeader',
                        type: 'POST',
                        data: data,
                        success: function (response) {
                          //  console.log(response);
                            var invoiceNumber = $('#invoiceNumber').val();
                            $('#invoiceCode').val(invoiceNumber);
                            $('h3.invoiceText').text('#' + invoiceNumber);

                            //
                            $('.invoiceCompany').text(response.company.company);
                            $('span.address').html(response.company.address)
                            $('#invoiceCurrencyCode').val(response.currencyCode);
                            $('#invoiceCurrency').val(response.currency);
                            currencyCode = response.currencyCode;
                            currency = response.currency;
                            invoiceId = response.invoice.id;
                            $('#invoiceId').val(invoiceId);
                         //   console.log('İnvoiceId'+invoiceId);
                            if (currencyCode == null) {
                                $('.currency-td').hide();
                            } else {
                                $('.currency-td').show();
                            }

                        }
                    });

                }
            });
        });
    </script>
@stop
