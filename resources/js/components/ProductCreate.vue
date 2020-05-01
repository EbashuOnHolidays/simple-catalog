<template>
  <div v-if="isShow" class="modal show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Добавить товар</h5>
          <button type="button" class="close" @click="onClose">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="category_id">Категория</label>
            <select id="category_id" v-model="productRecord.category_id" class="form-control">
              <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="name">Название товара</label>
            <input id="name" v-model="productRecord.name" class="form-control">
          </div>
          <div class="form-group">
            <label for="desc">Описание товара</label>
            <textarea id="desc" v-model="productRecord.desc" class="form-control" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label for="price">Цена товара</label>
            <input id="price" v-model="productRecord.price" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="onCreate">Добавить товар</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductCreate',
    props: {
      isShow: {
        type: Boolean,
        default: false
      }
    },
    data: () => ({
      categories: [],
      productRecord: {
        category_id: null,
        name: null,
        desc: null,
        price: 0
      }
    }),
    methods: {
      onClose() {
        this.$emit('onClose')
      },
      onCreate() {
        axios.post(`products`, this.productRecord)
          .then(response => {
            this.$emit('onCreate')
          })
      },
      loadCategories() {
        axios.get(`categories`)
          .then(response => {
            this.categories = response.data
          })
      }
    },
    mounted() {
      this.loadCategories()
    }
  }
</script>
