<template>
  <div class="row">
    <div class="col-12 text-right mb-4">
      <button class="btn btn-success btn-sm" @click="onShowCreateModal">Добавить товар</button>
    </div>

    <!--    TODO: Здесь бы хорошо работать с событиями по шине событий Bus, но так как это тестовое - оставлю как уже сделано-->
    <ProductListItem v-for="item in products" v-bind:data="item" v-bind:key="item.id" @onUpdate="onShowUpdateModal" @onDelete="onDeleteItem"/>

    <ProductCreate :isShow="showCreateModal" @onUpdate="onCreateItem" @onClose="onCloseCreateModal"/>
    <ProductUpdate :isShow="showUpdateModal" :product="product" @onUpdate="onUpdateItem" @onClose="onCloseUpdateModal"/>
  </div>
</template>

<script>
  import ProductListItem from './ProductListItem'
  import ProductCreate from './ProductCreate'
  import ProductUpdate from './ProductUpdate'

  export default {
    name: 'ProductList',
    components: {
      ProductUpdate,
      ProductCreate,
      ProductListItem
    },
    data: () => ({
      showCreateModal: false,
      showUpdateModal: false,

      products: [],

      product: {}
    }),
    methods: {
      loadProducts(page = 1) {
        axios.get(`products`, {
            params: {
              page: page
            }
          })
          .then(response => {
            this.products = response.data

            this.showCreateModal = false
            this.showUpdateModal = false
          })
      },
      loadProduct(id) {
        // TODO: Можно вынести в отдельный JS файл и вызывать оттуда
        return axios.get(`products/${id}`)
      },
      onShowCreateModal() {
        this.showCreateModal = true
      },
      onShowUpdateModal(id) {
        this.loadProduct(id)
          .then(response => {
            this.showUpdateModal = true
            this.product = response.data
          })
      },
      onCreateItem() {
        this.loadProducts()
      },
      onUpdateItem(id) {
        this.loadProducts()
      },
      onDeleteItem(id) {
        this.loadProducts()
      },
      onCloseCreateModal() {
        this.showCreateModal = false
      },
      onCloseUpdateModal() {
        this.showUpdateModal = false
      }
    },
    mounted() {
      this.loadProducts()
    }
  }
</script>
