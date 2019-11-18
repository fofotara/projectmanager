<template>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Cari Kartlar</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"
                        @click="showCreateAccountForm()"
                >
                    <i class="fa fa-plus-circle"></i> Yeni Car Kartı
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="table-responsive-">
                <table class="table table-hover table-center">
                    <thead>
                    <tr>
                        <th>Kodu</th>
                        <th>Adı</th>
                        <th>Yetkili</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="accounts.data" v-for="sItem in accounts.data">
                        <td>{{ sItem.code}}</td>
                        <td>{{ sItem.company}}</td>
                        <td>{{ sItem.user}}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" v-on:click="editAccount(sItem.id)">Düzenle</button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" v-on:click="editAccount(sItem.id)">Hareketleri</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- From Left Modal -->
            <div class="modal fade" id="modal-createAccount" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form method="post" @submit="storedCurrentAccount">
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
                                            <input type="text" v-model="account.code" id="code" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Firma Adı</label>
                                        <input type="text" v-model="account.company" id="company" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="user">Yetkili</label>
                                        <input type="text" v-model="account.user" id="user" class="form-control">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="vat">Telefonu</label>
                                            <input type="text" v-model="account.telephone" id="telephone"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vat">Email</label>
                                            <input type="text" v-model="account.email" id="email"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="tax">Vergi No</label>
                                            <input type="number" v-model="account.tax" id="tax" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="vat">Vergi Dairesi</label>
                                            <input type="text" v-model="account.taxname" id="vat" class="form-control">
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="vat">Adres</label>
                                        <textarea type="email" v-model="account.address" id="address"
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
    </div>
</template>

<script>
    export default {
        name: "cari",
        data() {
            return {
                errors: [],
                accounts: {},
                account: {
                    code: '',
                    company: '',
                    user: '',
                    tax: '',
                    taxname: '',
                    telephone: '',
                    email: '',
                    address: ''
                }
            }
        },
        created() {
            console.log('Cari component Loaded');
            this.indexCurrentAccount();
        },
        methods: {
            indexCurrentAccount() {
                axios
                    .get('/dashboard/current-account/index')
                    .then(response => {
                        console.log(response.data.data);

                        this.accounts = response.data.data;
                    })
            },
            editAccount(id) {
                console.log(id);
                axios
                    .get('/dashboard/current-account/edit/' + id)
                    .then(response => {
                        this.account = response.data.data;
                    })
            },
            showCreateAccountForm() {
                // this.errors = [];
                // this.account = [];
                jQuery("#modal-createAccount").modal("show");
            },
            storedCurrentAccount(e) {

                if (!this.account.code) {
                    this.errors.push("Hesap Kodu Yazmalısınız !...");
                }
                if (!this.account.company) {
                    this.errors.push("Firma Adı Yazmalısınız !...");
                }
                if (!this.account.user) {
                    this.errors.push("Yetkili Yazmalısınız !...");
                }
                if (!this.account.tax) {
                    this.errors.push("Vergi Numarası Yazmalısınız !...");
                }
                if (!this.account.taxname) {
                    this.errors.push("Vergi Dairesi Yazmalısınız !...");
                }
                if (!this.account.address) {
                    this.errors.push("Adres Yazmalısınız !...");
                }
                e.preventDefault();

                axios
                    .post('/dashboard/current-account/create', this.account)
                    .then(response => {
                        console.log(response.data);
                    })

            }
        }
    }

</script>

<style scoped>

</style>
