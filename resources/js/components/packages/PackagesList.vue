<template>
    <package-filters :fetch-data="fetchData"></package-filters>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col">
                <packages-list-to-group-form
                    :selected="selected"
                    :group-route="groupRoute"
                ></packages-list-to-group-form>
            </div>
            <div class="col">
                <p class="float-right">Total: {{ data.total }}</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <Pagination :data="data" @pagination-change-page="fetchData" />
            <table class="table table-sm table-borer">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox"
                                   class="mr-2"
                                   v-model="toggleAllSelected"
                                   @change="selectAllLike"
                            >
                        </th>
                        <th>Reference</th>
                        <th>Tracker</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="item in data.data">
                    <td><input type="checkbox" v-model="selected[item.id]"></td>
                    <td>{{ item.reference }}</td>
                    <td>{{ item.track_number }}</td>
                    <td>{{ createDate(item.created_at) }}</td>
                    <td>
                        <span :class="'border px-3 m-1 alert-' + item.status_color">{{ item.status_name }}</span>
                    </td>
                    <td>
                        <a :href="item.downLoad_label_link" class="mx-2"><font-awesome-icon icon="fas fa-download fa-sm" /></a>
                        <a :href="item.show_link" class="mx-2"><font-awesome-icon icon="fa-solid fa-circle-info" /></a>
                        <a href="#"
                           class="mx-2"
                           v-if="item.can_be_canceled"
                           @click="cancelPackage(item)"
                        >
                            <font-awesome-icon icon="fa-solid fa-trash" />
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination :data="data" @pagination-change-page="fetchData" />
        </div>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <select class="custom-select"
                        id="paginate"
                        v-model="paginate"
                        @change="fetchData(1)"
                >
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label for="paginate">Paginate</label>
            </div>
        </div>
    </div>
    <notifications position="bottom right" />
</template>

<script>
    import DateHelper from "../../mixins/DateHelper";
    import LaravelVuePagination from 'laravel-vue-pagination';

    const KEY_PAGE = 'page'
    const KEY_PAGINATE = 'paginate'

    export default {
        props: ['fetchRoute', 'groupRoute'],
        mixins: [DateHelper],
        components: {
            'Pagination': LaravelVuePagination
        },
        data() {
            return {
                filters: {
                    reference: '',
                    track_number: '',
                },
                data: {},
                toggleAllSelected: false,
                selected: {},
                page: localStorage.getItem(KEY_PAGE) || 1,
                paginate: localStorage.getItem(KEY_PAGINATE) || 10,
            }
        },
        mounted() {
            this.fetchData(this.page);
        },
        watch: {
            page(value) {
                localStorage.setItem(KEY_PAGE, value);
            },
            paginate(value) {
                localStorage.setItem(KEY_PAGINATE, value);
            }
        },
        methods: {
            async fetchData(page = 1, filters = {}) {
                this.page = page;
                this.toggleAllSelected = false;
                this.clearSelected();

                await axios.get(this.fetchRoute, {
                    params: {
                        'page': page,
                        'paginate': this.paginate,
                        ...filters
                    }
                }).then(response => {
                    this.data = response.data;

                    this.data.data.forEach((item) => {
                        if (!this.selected.hasOwnProperty(item.id)) {
                            this.selected[item.id] = false;
                        }
                    });
                }).catch(() => {
                    this.$notify({
                        title: "Fetch error",
                        type: 'error'
                    });
                });
            },
            async cancelPackage(item) {
                await axios.delete(item.cancel_link).then(() => {
                    this.$notify({
                        title: `Package ${item.track_number} canceled`,
                        type: 'warn'
                    });
                    this.fetchData(this.page);
                }).catch(() => {
                    this.$notify({
                        title: "Cancel error",
                        type: 'error'
                    });
                });
            },
            selectAllLike() {
                this.data.data.forEach((item) => {
                    this.selected[item.id] = event.target.checked;
                });
            },
            clearSelected() {
                for (const [key, value] of Object.entries(this.selected)) {
                    if (!value) {
                        delete this.selected[key];
                    }
                }
            }
        }
    }
</script>
