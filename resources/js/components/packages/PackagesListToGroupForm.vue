<template>
    <p>Selected: {{ selectedCount }}</p>
    <form :action="groupRoute" method="post">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" v-for="selectedId in selectedIds" :value="selectedId" name="packages[]">
        <button type="submit"
                class="btn btn-sm btn-primary"
                :disabled="selectedCount <= 1"
        >
            to Group
        </button>
    </form>

</template>

<script>

    import CsrfToken from "../../mixins/CsrfToken";

    export default {
        props: ['groupRoute', 'selected'],
        mixins: [CsrfToken],
        methods: {
            toGroup(e) {
                e.preventDefault();
                console.log({
                    submit: e.target.elements
                })
            }
        },
        computed: {
            selectedCount() {
                let count = 0;
                Object.values(this.selected).forEach(value => {
                    if (value) {
                        count++
                    }
                });
                return count;
            },
            selectedIds() {
                let selectedIds = [];
                for (const [key, value] of Object.entries(this.selected))
                    if (value)
                        selectedIds.push(key);
                return selectedIds;
            }
        }
    }
</script>
