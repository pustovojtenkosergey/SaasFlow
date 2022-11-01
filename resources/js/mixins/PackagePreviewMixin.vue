<script>

export default {
    methods: {
        prepareViewData(data) {
            if (data === null) {
                return null;
            }

            let obj = Object.create(null);

            for (let [key, value] of Object.entries(data)) {
                key = key.replaceAll('_', ' ').replace(' id', '').toUpperCase();
                if (typeof value === 'object') {
                    obj[key] = this.prepareViewData(value);
                } else {
                    obj[key] = value;
                }
            }

            return obj;
        },
    }
}
</script>
