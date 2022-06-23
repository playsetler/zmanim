<template>
    <a href="#" class="actions-container" @click.prevent="isVisible = !isVisible" @blur.prevent="isVisible = !isVisible">
        <i class="bi bi-three-dots"></i>
        <Transition name="slide-fade">
            <ul class="dropdown-menu" v-show="isVisible">
                <li><a href="#" class="edit dropdown-item" @click.prevent="edit($event, id)"><i class="bi bi-pencil-square"></i>Edit</a></li>
                <li><a href="#" class="delete dropdown-item" @click.prevent="delete($event, [id])"><i class="bi bi-trash"></i>Delete</a></li>
            </ul>
        </Transition>
    </a>
</template>

<script>

export default {
    name: "Dropdown",
    props: ["id", "edit", "delete"],
    data: function() {
        return {
            isVisible: false
        }
    },
    methods: {
        
    }
}
</script>

<style scoped>
.table tbody .table-action .actions-container {
    color:var(--black) !important;
    display: flex;
}

.table tbody .table-action .actions-container > i {
    font-size: 16px;
    line-height: 31px;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: row;
}

.table tbody .table-action .actions-container:hover > i {
    background-color: #EEF2F6;
    border-radius: 20px;
    color: var(--accent-color-regular);
}

.table tbody ul.dropdown-menu {
    right: 50px;
    top: 10px;
    left: auto;
    text-align: left;
    display: block;
}

.slide-fade-enter-active {
  transition: all 0.3s cubic-bezier(0, 0.6, 0, 0.9);
}

.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(0, 0.6, 0, 0.9);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(40px);
  opacity: 0;
}
</style>