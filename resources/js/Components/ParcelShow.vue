<template>
    <div class="row">
        <div class="col-6 p-2 border">
            <pre>{{ request_data }}</pre>
        </div>
        <div class="col-6 p-2 border">
            <pre>{{ response_data }}</pre>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['parcel'],
        data() {
          return {
              request_data: '',
              response_data: '',
          }
        },
        mounted() {
            this.request_data = JSON.stringify(JSON.parse(this.parcel.request_data), undefined, 2);
            this.response_data = JSON.stringify(JSON.parse(this.parcel.response_data), undefined, 2);
        }
    }
</script>
