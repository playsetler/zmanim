<template>
    <ul>
        <li v-for="(work, index) in works" :key="index">
            {{ work }}
        </li>
    </ul>
    <Test v-slot:default="slotProps">
        <ul :id="works[selected]">
            <li v-for="(work, index) in slotProps.works" :key="index">
                {{ work }}
            </li>
        </ul>
    </Test>
{{works[selected]}}
    <button @click.prevent="change">Изменить</button>
</template>

<script>
import { computed } from 'vue';
import Test from '../components/Test.vue';

export default {
    name: "",
    components: { Test },
    data() {
        return {
            works: ['Покормить кота', 'Купить билеты'],
            selected: null
        }
    },
    provide() {
        return {
            works: this.works,
            selected: computed(() => this.selected)
        }
    },
    methods: {
        change: function() {
            this.selected = this.selected == null ? 1 : null;
        }
    }
}
</script>

<style scoped>

</style>