<template>
  <div v-if="isShow" class="modal show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Добавить категорию</h5>
          <button type="button" class="close" @click="onClose">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Название категории</label>
            <input id="name" v-model="categoryRecord.name" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" @click="onCreate">Добавить категорию</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'CategoryCreate',
    props: {
      isShow: {
        type: Boolean,
        default: false
      }
    },
    data: () => ({
      categoryRecord: {
        name: null
      }
    }),
    methods: {
      onClose() {
        this.$emit('onClose')
      },
      onCreate() {
        axios.post(`categories`, this.categoryRecord)
          .then(response => {
            this.$emit('onCreate')
          })
      }
    }
  }
</script>
