<template>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Yeni Fatura</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"
                        v-on:click="createNewInvoiceModal()"
                >
                    <i class="fa fa-plus-circle"></i> Yeni Stok Kartı
                </button>
            </div>
        </div>
        <div class="block-content">


            <!-- From Left Modal -->
            <div class="modal fade show" id="modal-createInvoice" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form method="post" >
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

                                    <span v-if="errors.length">
                                        <b>Bu Hataları gözden geçirin :</b>
                                    <ul>
                                        <li v-for="error in errors" :key="error">{{ error }}</li>
                                    </ul>
                                    </span>

                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label for="code">Kodu</label>
                                            <input type="text"  id="code" class="form-control">
                                        </div>
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
    </div>
</template>

<script>

    // $(document).ready(function () {
    //     jQuery('#modal-createInvoice').modal('show');
    // });
    //jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2']); });
    export default {
        name: "create",
        data() {
            return {
                errors: [],

            };
        },
        ready(){

        },
        created() {
            console.log("Component mounted.");
            this.createNewInvoiceModal.call();
        },
        methods:{
            createNewInvoiceModal(){
                console.log("Open Modal.");
                jQuery('#modal-createInvoice').modal('show');
            }
        }
    }
</script>

<style scoped>

</style>
