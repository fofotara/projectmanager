<template>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Yeni Fatura</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"
                        v-on:click="createNewInvoiceModal()"
                >
                    <i class="fa fa-plus-circle"></i> Yeni Fatura
                </button>
            </div>
        </div>
        <div class="block-content">


            <div class="form-group row">

                <div class="col-md-6">
                    <label class="col-12">Firma Adı</label>
                    <autocomplete v-model="invoice.companyId"
                                  placeholder="Firma Adını Yazın"
                                  input-class="js-select2 form-control"
                                  :source="accounts"
                                  results-property="id"
                                  results-display="company">
                    </autocomplete>

                </div>
                <div class="col-md-6">
                    <vuejsDatepicker v-model="invoice.dateTime" input-class="form-control"
                                     :format="customFormatter" :language="tr"></vuejsDatepicker>
                </div>

            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="code">Kodu</label>
                    <input type="text" id="code" class="form-control">
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    $(document).ready(function () {
        jQuery('#modal-createInvoice').modal('show');

        console.log("Open Modal.");
    });

    import Autocomplete from 'vuejs-auto-complete'
    import vuejsDatepicker from 'vuejs-datepicker';
    import tr from 'vuejs-datepicker/dist/locale/translations/tr'
    import moment from 'vue-moment';



    export default {
        components: {
            Autocomplete,
            vuejsDatepicker
        },

        name: "create",

        data() {
            return {
                tr: tr,
                customFormatter(date) {
                    return moment(date).format('MM D YYYY');
                    },
                invoice: {
                    companyId: '',
                    dateTime: ''
                },
                errors: [],
                accounts: [],


            };
        },
        ready() {

        },
        created() {
            console.log("Component mounted.");
            this.getCurrentAccount();

        },
        methods: {

            getCurrentAccount() {
                axios
                    .get('/dashboard/getCurrentAccount')
                    .then(response => {
                        console.log(response.data);
                        this.accounts = response.data;
                    })
            },
            createNewInvoiceModal() {
                jQuery('#modal-createInvoice').modal('show');
            }

        }

    }
</script>

<style scoped>

</style>
