<template>
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle"
           href="#"
           id="alertsDropdown"
           role="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
           @click="watchALl"
        >
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter"
                  v-if="countNew"
            >
                {{ countNew }}
            </span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
             aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                New alerts
            </h6>
            <a v-for="item in list"
               class="dropdown-item d-flex align-items-center"
               :href="item.link"
               @mouseover="item.active = false"
            >
                <div class="mr-3">
                    <div :class="'icon-circle ' + item.icon.class">
                        <i :class="item.icon.type + ' text-white'"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ item.date }}</div>
                    <span :class="item.active ? 'font-weight-bold' : ''">{{ item.message }}</span>
                </div>
            </a>
            <a class="dropdown-item text-center small text-gray-500" :href="allFlowRoute">Show All Flow</a>
        </div>
    </li>

</template>

<script>

    import DateHelper from "../../Mixins/DateHelper";

    const icons = {
        file: 'fas fa-file-alt',
        donate: 'fas fa-donate',
        triangle: 'fas fa-exclamation-triangle',
    };

    class Alert {
        constructor(message, date, icon, link = '#', active = true) {
            this.message = message;
            this.date = date;
            this.icon = icon;
            this.link = link;
            this.active = active;
        }
    }

    export default {
        props: ['allFlowRoute'],
        mixins: [DateHelper],
        data() {
            return {
                list: []
            }
        },
        mounted() {
            Echo.channel('flow')
                .listen('ParcelCreated', event => {
                    this.list.unshift(new Alert(
                        event.message,
                        this.createDate(event.date) || this.getNowDate(),
                        {
                            type: icons.file,
                            class: 'bg-' + (event.success ? 'success' : 'danger')
                        },
                        event.link || '#'
                    ));
                    this.$notify({
                        title: event.message,
                        type: event.success ? 'success' : 'error'
                    });
                });
        },
        methods: {
            watchALl() {
                this.list.forEach(item => item.active = false);
            }
        },
        computed: {
            countNew() {
                return this.list.reduce((counter, item) => {
                    if (item.active)
                        counter++;
                    return counter;
                }, 0);
            }
        }
    }
</script>
