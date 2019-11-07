<template>

    <div class="block" id="stock">
        <div class="block-header block-header-default">
            <h3 class="block-title">Stok Listesi</h3>
            <div class="block-options">
                <button type="button" class="btn btn-sm btn-square btn-primary min-width-125 mb-10"
                        v-on:click="showCreateStockForm()"
                >
                    <i class="fa fa-plus-circle"></i> Yeni Stok Kartı
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-hover table-center">
                    <thead>
                    <tr>
                        <th>Kodu</th>
                        <th>Adı</th>
                        <th>Tipi</th>
                        <th>Kdv</th>
                        <th class="text-center">--</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>
                            <input class="form-control bg-gd-light" v-model="filter.searchCode" placeholder="Stok Kodu  ile arama yapın">
                        </th>
                        <th>
                            <input class="form-control bg-gd-light" v-model="filter.name" placeholder="Stok Adı ile arama yapın">
                        </th>

                        <th></th>
                        <th></th>
                        <th>
                            <button v-on:click="getStocksFilter" class="btn btn-success btn-sm">Ara</button>
                        </th>
                    </tr>
                    <tr v-if="stocks.data" v-for="sItem in stocks.data" >
                        <td>{{ sItem.code }}</td>
                        <td>{{ sItem.name }}</td>
                        <td>{{ sItem.unit }}</td>
                        <td>{{ sItem.tax }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" v-on:click="editStock(sItem.id)">Düzenle</button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- From Left Modal -->
            <div class="modal fade" id="modal-createStock" tabindex="-1" role="dialog" aria-labelledby="modal-fromleft"
                 aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" @submit="checkForm" method="post">
                            <div class="block block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title" id="nestedName">Yeni Stok Kartı</h3>
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
                                            <input type="text" v-model="stock.code" id="code" class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="name">Adı</label>
                                        <input type="text" v-model="stock.name" id="name" class="form-control">
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <label for="unit">Tipi</label>
                                            <select name="unit" v-model="stock.unit" id="unit" class="form-control">
                                                <option v-for="uItem in units" v-bind:value="uItem.name" :key="uItem.id">
                                                    {{uItem.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tax">Kdv Oranı</label>
                                            <select name="tax" v-model="stock.tax" id="tax" class="form-control">
                                                <option v-for="tItem in taxes" v-bind:value="tItem.value" :key="tItem.id">
                                                    {{tItem.value}}
                                                </option>
                                            </select>
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
            <pagination :data="stocks" @pagination-change-page="getStocks"></pagination>

        </div>

    </div>

</template>

<script>

export default {
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
    this.getTax();
    this.getUnit();
    this.getStocks();
  },
  methods: {
    showCreateStockForm() {
      this.stock.id = null;
      this.stock.code = null;
      this.stock.name = null;
      this.stock.unit = null;
      this.stock.tax = null;
      jQuery( "#modal-createStock" ).modal( "show" );
    },
    getTax() {
        // eslint-disable-next-line no-undef
      axios.get( "/dashboard/tax" )
        .then( response => (
          this.taxes = response.data
        ) );
    },
    getUnit() {
      axios
        .get( "/dashboard/unit" )
        .then( ( response ) => (
          this.units = response.data
        ) );
    },
    getStocks( page ) {
      if ( typeof page === "undefined" ) {
        page = 1;
      }
      axios
        .get( `/dashboard/stock/stocks?page=${page}` )
        .then( ( response ) => (
          this.stocks = response.data
        ) );
    },
    async getStocksFilter() {
      await axios
        .post( "/dashboard/stock/filter", this.filter )
        .then( ( response ) => {

          // console.log(response.data)
          this.stocks = response.data;
        } );
    },
    checkForm( e ) {
      this.errors = [];
      if ( !this.stock.code ) {
        this.errors.push( "Stok Kodu Yazmalısınız !..." );
      }
      if ( !this.stock.name ) {
        this.errors.push( "Stok Adı Yazmalısınız !..." );
      }
      if ( !this.stock.unit ) {
        this.errors.push( "Stok Birimi Yazmalısınız !..." );
      }
      if ( !this.stock.tax ) {
        this.errors.push( "Kdv Seçmelisiniz !..." );
      }
      e.preventDefault();
      e.target.reset();
      if ( !this.errors.length ) {
        // eslint-disable-next-line no-undef
        axios
          .post( "/dashboard/stock/create", this.stock )
          .then( ( response ) => {
            console.log( response.data );
            jQuery( "#modal-createStock" ).modal( "hide" );
            this.getStocks();
            e.target.reset();
          } ).catch( ( e ) => {
            this.errors.push( e );
          } );
      }
    },
    editStock( id ) {
      console.log( id );
      axios
        .get( `/dashboard/stock/edit/${id}` )
        .then( ( response ) => {
          this.stock = response.data.data;
          console.log( response.data.data );
          this.stock.id = id;
          $( "#modal-createStock" ).modal( "show" );
        } );
    }
  }
};
</script>
