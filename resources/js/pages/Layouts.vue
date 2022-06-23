<template>
<div class="container-md">
<Header />
    <main>
        <h5>All layouts</h5>
        <table v-if="isLayoutsLoad" class="table table-borderless">
            <thead>
                <tr>
                    <td scope="col" class="table-col-chekbox">
                        <div class="table-select">
                            <Checkbox id="select-all" @change="SelectAllLayouts" />
                        </div>
                    </td>
                    <th scope="col"><div class="table-name">NAME</div></th>
                    <th scope="col"><div class="table-time">MODIFIED</div></th>
                    <th scope="col"><div class="table-action">ACTIONS</div></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="layout in layouts" :key="layout.id">
                    <td scope="row" class="table-col-chekbox">
                        <div class="table-select">
                            <!-- <Checkbox :id="`select-${layout.id}`" @change="SelectedChange" v-model="selectedLayouts" value="{{ layout.id }}" /> -->
                            <input class="form-check-input" type="checkbox" :id="`select-${layout.id}`" v-model="selectedLayouts" :value="layout.id">
                            <label class="form-check-label" :for="`select-${layout.id}`"></label>
                        </div>
                    </td>
                    <td><div class="table-name"><a href="#" @click.prevent="EditLayout($event, layout.id)">{{ layout.name }}</a></div></td>
                    <td><div class="table-time">{{ layout.updated_at }}</div></td>
                    <td class="td-action">
                        <div class="table-action">
                            <Dropdown :id="`${layout.id}`" :edit="EditLayout" :delete="DeleteLayouts" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <Loader v-else />

        <div class="row g-0">
            <div class="col">
                <button class="btn btn-primary mb-3" @click.prevent="AddLayout">Add Layout</button>
                <button class="btn btn-secondary mb-3" :disabled="isDeleteDisabled" @click.prevent="DeleteLayouts">Delete</button>
            </div>
        </div>
    </main>{{selectedLayouts}}

</div>
</template>

<script>
    import Header from "../components/Header.vue";
    import Dropdown from '../components/Dropdown.vue';
    import Checkbox from '../components/Checkbox.vue';
    import Loader from "../components/Loader.vue";
    export default {
        name: "Layouts",
        components: { Header, Dropdown, Checkbox, Loader },
        data() {
            return {
                layouts: [],
                selectedLayouts:[],
                isLayoutsLoad: true
            }
        },
        computed: {
            isDeleteDisabled() {
                return this.selectedLayouts.length > 0 ? false : true;
            }
        },
        mounted() {
            this.GetLayouts();
        },
        methods: {
            GetLayouts: function() {
                this.isLayoutsLoad = false;
                axios.get('/api/layouts').then(response => {
                    this.layouts = response.data;
                    this.isLayoutsLoad = true;
                }).catch(error => {
                    console.log(error.response);
                });
            },
            SelectAllLayouts: function(checkbox) {
                if (checkbox.checked) {
                    this.layouts.forEach((layout) => {
                        this.selectedLayouts.push(layout.id);
                    });
                } else {
                    this.selectedLayouts.splice(0);
                }
            },
            AddLayout: function() {
                this.$router.push({name: "Create"});
            },
            DeleteLayouts: function(event, ids = null) {
                var deletedLayouts = [];
                if(ids != null) {
                    deletedLayouts = ids;
                } else {
                    deletedLayouts = Array.from(this.selectedLayouts);
                    this.selectedLayouts.splice(0);
                }
                deletedLayouts = deletedLayouts.map(string => Number(string));
                axios.post("/api/layouts/delete", deletedLayouts).then(response => {console.log(response);
                    this.GetLayouts();
                }).catch(error => {
                    console.log(error.response);
                });
            },
            EditLayout: function(event, id) {
                this.$router.push({name: "Edit", params: {id: id}});
            }
        }
    }
</script>

<style>
    
body {
    background-color: var(--white);
}

.navbar {
    background-color: var(--black);
}

.navbar-brand img {
    margin-right:10px;
    width: 40px;
}

.dropdown-divider {
    margin: 0px;
}

main {
    padding: 100px 0px 50px !important;
}

.table>:not(caption)>*>* {
    padding: 1rem 0.5rem;
}

.table {
    border-collapse: separate;
    border-spacing: 0 5px;
}

.table tbody > tr {
    background-color: #fff;
    border-radius: 5px;
    height: 74px;
    max-height: 74px;
}

.table tbody > tr > td {
    vertical-align: middle;
}

.table thead {
    font-size: 11px;
    color: var(--gray);
}

.table thead .table-col-chekbox, .table tbody .table-col-chekbox {
    width: 80px;
    min-width: 60px;
    text-align: center;
    position: relative;
}

.table tbody .table-name {
    min-width: 40%;
    text-align: left;
    font-weight: bold;
}

.table tbody .table-time {
    min-width: 40%;
    text-align: left;
    font-weight:lighter;
}

.table tbody .td-action {
    text-align: center;
    width: 60px;
}

.table tbody .table-action {
    text-align: center;
    position: relative;
    display: inline-block;
    vertical-align: middle;
}

.table .table-select input[type="checkbox"] + label {
    justify-content: center;
}
</style>