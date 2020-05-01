<template>
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-header">
        {{ data.name }}
      </div>

      <div class="card-body">
        <button class="btn btn-warning btn-sm" @click="onUpdate">Редактировать</button>
        <button class="btn btn-danger btn-sm" @click="onDelete">Удалить</button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'CategoryListItem',
    props: {
      data: {
        required: true,
        type: Object
      }
    },
    methods: {
      onUpdate() {
        this.$emit('onUpdate', this.data.id)
      },
      onDelete() {
        if (confirm('Удалить эту категорию?')) {
          axios.delete(`categories/${this.data.id}`)
            .then(response => {
              this.$emit('onDelete', this.data.id)
            })
        }
      }
    }
  }
</script>
