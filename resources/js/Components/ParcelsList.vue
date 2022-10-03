<template>
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-sm table-borer">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Tracker</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="parcel in parcels">
                    <td>{{ parcel.reference }}</td>
                    <td>{{ parcel.tracker_number }}</td>
                    <td>{{ createDate(parcel.created_at) }}</td>
                    <td>
                        <span :class="'border px-3 m-1 alert-' + parcel.status.color">{{ parcel.status.name }}</span>
                    </td>
                    <td>
                        <a :href="parcel.link" class="mx-2"><font-awesome-icon icon="fa-solid fa-circle-info" /></a>
                        <a href="#" class="mx-2"><font-awesome-icon icon="fa-solid fa-trash" /></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import DateHelper from "../Mixins/DateHelper";

    export default {
        props: ['fetchRoute'],
        mixins: [DateHelper],
        data() {
            return {
                parcels: []
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                await axios.get(this.fetchRoute).then(response => {
                    this.parcels = response.data;
                }).catch(() => {
                    this.$notify({
                        title: "Fetch error",
                        type: 'error'
                    });
                });
            }
        }
    }
</script>
