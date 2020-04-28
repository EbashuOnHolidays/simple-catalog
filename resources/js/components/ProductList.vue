<template>
  <div class="row justify-content-center">
    <ProductListItem v-for="item in products" v-bind:data="item" v-bind:key="item.id" @onUpdate="onUpdateItem" @onDelete="onDeleteItem"/>

    <ProductCreate/>
    <ProductUpdate :id="productId"/>
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
      ProductListItem},
    data: () => ({
      products: [],

      productId: null
    }),
    methods: {
      loadProducts(page = 1) {
        axios.get(`products`)
          .then(response => {
            this.products = response.data
          }, {
            params: {
              page: page
            }
          })
      },
      onUpdateItem(id) {
        this.productId = id
      },
      onDeleteItem(id) {
        axios.delete(`products/${id}`)
          .then(response => {
            console.log('OKAY')

            this.loadProducts()
          })
      }
    },
    mounted() {
      this.loadProducts()
    }
  }
</script>
