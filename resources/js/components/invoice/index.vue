<template>
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Cari Kartlar</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"

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
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        name: "index",
        data() {
            return {
                errors: [],
                stocks: {},
                taxes: [],
                units: [],
                stock: {
                    code: "",
                    name: "",
                    unit: "",
                    tax: "",
                    id: null
                },
                filter: {
                    searchCode: ""
                }
            };
        },
        created() {
            console.log( "Component mounted." );

        },
    }
</script>

<style scoped>

</style>
