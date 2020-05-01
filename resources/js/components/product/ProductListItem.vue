<template>
  <div class="col-md-12 mb-4">
    <div class="card">
      <div class="card-header">
        <span class="float-right">{{ data.category.name }}</span>

        {{ data.name }}
      </div>

      <div class="card-body">
        <p>{{ data.desc }}</p>

        <p>${{ data.price }}</p>

        <button class="btn btn-warning btn-sm" @click="onUpdate">Редактировать</button>
        <button class="btn btn-danger btn-sm" @click="onDelete">Удалить</button>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductListItem',
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
        if (confirm('Удалить товар?')) {
          axios.delete(`products/${this.data.id}`)
            .then(response => {
              this.$emit('onDelete', this.data.id)
            })
        }
      }
    }
  }
</script>
