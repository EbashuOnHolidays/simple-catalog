<template>
  <div v-if="isVisible" class="modal show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
<!--            <label for="category_id">Категория</label>-->
<!--            <select id="category_id" v-model="product.category_id">-->
<!--              <option></option>-->
<!--            </select>-->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'ProductUpdate',
    props: {
      id: {
        required: true
      }
    },
    data: () => ({
      product: {
        category_id: null
      }
    }),
    methods: {
      onUpdate() {
        this.$emit('onUpdate', this.data.id)
      },
      loadRecord() {
        axios.get(`products/${this.id}`)
          .then(response => {
            this.product = response.data
          })
          .catch(error => {
          })
      },
    },
    computed: {
      isVisible() {
        return !_.isNull(this.id) && !_.isNull(this.product)
      }
    },
    watch: {
      id: function (newVal, oldVal) {
        // if (!_.isEmpty(newVal)) {
          this.product = null

          this.loadRecord()
        // }
      }
    }
  }
</script>
