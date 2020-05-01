<template>
  <div v-if="isShow" class="modal show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Редактировать категорию</h5>
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
          <button type="button" class="btn btn-success" @click="onUpdate">Сохранить категорию</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'CategoryUpdate',
    props: {
      isShow: {
        type: Boolean,
        default: false
      },
      category: {
        required: true
      }
    },
    data: () => ({
      categories: [],
      categoryRecord: {
        name: null,
      }
    }),
    methods: {
      onClose() {
        this.$emit('onClose')
      },
      onUpdate() {
        axios.put(`categories/${this.category.id}`, this.categoryRecord)
          .then(response => {
            this.$emit('onUpdate', this.category.id)
          })
      }
    },
    watch: {
      category: function (newVal, oldVal) {
        if (newVal !== null) {
          this.categoryRecord = newVal
        }
      }
    }
  }
</script>
