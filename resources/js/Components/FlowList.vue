<template>
    <ol>
        <li v-for="item in list">
            <a class="dropdown-item d-flex align-items-center"
               :href="item.link"
            >
                <div class="mr-3">
                    <div :class="'icon-circle ' + item.icon.class">
                        <i :class="item.icon.type + ' text-white'"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ item.date }}</div>
                    <span>{{ item.message }}</span>
                </div>
            </a>
        </li>
    </ol>
</template>

<script>

    import DateHelper from "../Mixins/DateHelper";

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
        props: ['jsonList'],
        mixins: [DateHelper],
        data() {
            return {
                list: [],
            }
        },
        mounted() {
            Object.values(JSON.parse(this.jsonList)).forEach(item => {
                this.list.push(new Alert(
                    item.message,
                    this.createDate(item.date) || this.getNowDate(),
                    {
                        type: icons.file,
                        class: 'bg-' + (item.success ? 'success' : 'danger')
                    },
                    item.link || '#'
                ));
            });
        }
    }
</script>
