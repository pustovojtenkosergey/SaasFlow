<template>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item" v-for="(tab, index) in tabList" :key="index">
                <a class="nav-link"
                   v-text="tab"
                   :class="index === activeTab ? 'active' : ''"
                   :href="'#' + tab"
                   @click="selectTab(tab)"
                   :ref="'tab-' + index"
                ></a>
            </li>
        </ul>

        <template v-for="(tab, index) in tabList">
            <div :key="index" v-if="index === activeTab">
                <slot :name="`tabPanel-${index}`" />
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        tabList: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            activeTab: null,
            isActive: false
        };
    },
    mounted() {
        this.$refs['tab-' + 0][0].click();
    },
    methods: {
        selectTab(selectedTab) {
            this.tabList.forEach((tab, index) => {
               if (selectedTab === tab) {
                   this.activeTab = index;
               }
            });
        }
    }
};
</script>

<style>
.flex {
    display: flex;
}
</style>
