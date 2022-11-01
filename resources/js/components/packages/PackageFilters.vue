<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="form-row">
                    <input type="text"
                           class="form-control"
                           id="reference"
                           v-model="filters.reference"
                    >
                    <label for="reference">Reference</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <input type="text"
                           class="form-control"
                           id="track_number"
                           v-model="filters.track_number"
                    >
                    <label for="track_number">Track number</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <input type="date"
                           class="form-control"
                           id="created_from"
                           v-model="filters.created_from"
                           :max="maxDate"
                    >
                    <label for="created_from">Created from</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-row">
                    <input type="date"
                           class="form-control"
                           id="created_from"
                           v-model="filters.created_to"
                           :max="maxDate"
                    >
                    <label for="created_to">Created to</label>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-sm btn-warning mx-2" @click="clear">Clear</button>
            <button class="btn btn-sm btn-primary mx-2" @click="submit">Find</button>
        </div>
    </div>
</template>

<script>
    import moment from "moment/moment";

    const defaultFilters = {
        reference: '',
        track_number: '',
        created_from: '',
        created_to: '',
    };

    export default {
        props: ['fetchData'],
        data() {
            return {
                maxDate: moment().format('YYYY-MM-DD'),
                filters: {...defaultFilters}
            }
        },
        methods: {
            clear() {
                let hasFilters = false;
                Object.values(this.filters).forEach(f => {
                   if (f !== '') {
                       hasFilters = true;
                   }
                });

                if (hasFilters) {
                    this.filters = {...defaultFilters};
                    this.submit();
                }
            },
            submit() {
                this.fetchData(1, this.filters)
            },
        }
    }
</script>
