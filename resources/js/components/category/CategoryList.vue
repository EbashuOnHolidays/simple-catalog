<template>
  <div class="row">
    <div class="col-12 text-right mb-4">
      <button class="btn btn-success btn-sm" @click="onShowCreateModal">Добавить категорию</button>
    </div>

    <!--    TODO: Здесь бы хорошо работать с событиями по шине событий Bus, но так как это тестовое - оставлю как уже сделано-->
    <CategoryListItem v-for="item in categories" v-bind:data="item" v-bind:key="item.id" @onUpdate="onShowUpdateModal" @onDelete="onDeleteItem"/>

    <CategoryCreate :isShow="showCreateModal" @onCreate="onCreateItem" @onClose="onCloseCreateModal"/>
    <CategoryUpdate :isShow="showUpdateModal" :category="category" @onUpdate="onUpdateItem" @onClose="onCloseUpdateModal"/>
  </div>
</template>

<script>
  import CategoryListItem from './CategoryListItem'
  import CategoryCreate from './CategoryCreate'
  import CategoryUpdate from './CategoryUpdate'

  export default {
    name: 'CategoryList',
    components: {
      CategoryUpdate,
      CategoryCreate,
      CategoryListItem
    },
    data: () => ({
      showCreateModal: false,
      showUpdateModal: false,

      categories: [],

      category: {}
    }),
    methods: {
      loadCategories(page = 1) {
        axios.get(`categories`, {
            params: {
              page: page
            }
          })
          .then(response => {
            this.categories = response.data

            this.showCreateModal = false
            this.showUpdateModal = false
          })
      },
      loadCategory(id) {
        // TODO: Можно вынести в отдельный JS файл и вызывать оттуда
        return axios.get(`categories/${id}`)
      },
      onShowCreateModal() {
        this.showCreateModal = true
      },
      onShowUpdateModal(id) {
        this.loadCategory(id)
          .then(response => {
            this.showUpdateModal = true
            this.category = response.data
          })
      },
      onCreateItem() {
        this.loadCategories()
      },
      onUpdateItem(id) {
        this.loadCategories()
      },
      onDeleteItem(id) {
        this.loadCategories()
      },
      onCloseCreateModal() {
        this.showCreateModal = false
      },
      onCloseUpdateModal() {
        this.showUpdateModal = false
      }
    },
    mounted() {
      this.loadCategories()
    }
  }
</script>
