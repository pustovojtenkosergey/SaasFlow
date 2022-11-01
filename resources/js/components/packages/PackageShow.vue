<template>
    <div class="row">
        <div class="col-7">
            <vue-pdf-embed :source="labelUrl" />
        </div>
        <div class="col-5">
            <json-tree :raw="packageData"></json-tree>
        </div>
    </div>
</template>

<script>
    import PackagePreviewData from "../../mixins/PackagePreviewMixin";
    import VuePdfEmbed from "vue-pdf-embed";

    export default {
        props: ['package', 'labelUrl'],
        mixins: [PackagePreviewData],
        components: {
            VuePdfEmbed,
        },
        data() {
          return {
              packageData: '{}',
          }
        },
        mounted() {
            this.packageData = JSON.stringify(this.prepareViewData(JSON.parse(this.package.data)), undefined, 2);
        }
    }
</script>

<style>
.vue-pdf-embed > div {
    margin-bottom: 8px;
    box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
    width: 300px;
}
</style>
